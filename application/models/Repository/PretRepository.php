<?php

namespace Repository;

use Entity\Pret;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository as EntityRepository;

class PretRepository extends EntityRepository
{
    public function buildDefaultQuery()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p')
            ->from('Entity\Pret', 'p');

        return $qb;
    }

    public function getAll()
    {
        $qb = $this->buildDefaultQuery();
        return new ArrayCollection($qb->getQuery()->getResult());
    }

    public function get($id)
    {
        $qb = $this->buildDefaultQuery();
        $qb->where('p.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    public function search($data = null)
    {
        $data['count'] = $data['count'] ?? false;
        if ($data['count']) {
            $qb = $this->_em->createQueryBuilder();
            $qb->select('count(p.id)')
                ->from('Entity\Pret', 'p');
        } else {
           $qb = $this->buildDefaultQuery();
            if (!empty($data['limit']))
                $qb->setMaxResults($data['limit']);
            if (!empty($data['page']))
                $qb->setFirstResult( ($data['page']-1) * $data['limit']);
            if (!empty($data['order']))
                $qb->orderBy('p.'.$data['order'], 'ASC');
        }
        return $data['count'] ?
            $qb->getQuery()->getSingleScalarResult()
            : $qb->getQuery()->getResult();
    }

}
