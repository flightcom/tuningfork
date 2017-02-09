<?php

namespace Repository;

use Entity\Instrument;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository as EntityRepository;

class InstrumentRepository extends EntityRepository
{
    public function buildDefaultQuery()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i', 'm')
            ->from('Entity\Instrument', 'i')
            ->leftJoin('i.marque', 'm');

        return $qb;
    }

    public function getAll()
    {
        $qb = $this->buildDefaultQuery();
        return $qb->getQuery()->getResult();
    }

    public function get($id)
    {
        $qb = $this->buildDefaultQuery();
        $qb->where('i.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    public function search($data = null)
    {
        $data['count'] = $data['count'] ?? false;
        if ($data['count']) {
            $qb = $this->_em->createQueryBuilder();
            $qb->select('count(i.id)')
                ->from('Entity\Instrument', 'i');
        } else {
           $qb = $this->buildDefaultQuery();
            if ($data['limit'])
                $qb->setMaxResults($data['limit']);
            if ($data['page'])
                $qb->setFirstResult( ($data['page']-1) * $data['limit']);
            if ($data['order'])
                $qb->orderBy('i.'.$data['order'], 'ASC');
        }
        return $data['count'] ?
            $qb->getQuery()->getSingleScalarResult()
            : $qb->getQuery()->getResult();
    }

}
