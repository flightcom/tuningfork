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
        $qb->select('i')
            ->from('Entity\Instrument', 'i');

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

    public function search($params = null, $count = false)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->from('Entity\Instrument', 'i');

        if ($count) {
            $qb->select('count(i.id)');
        } else {
            $qb->select('distinct i');
        }

        foreach ($params['filters'] as $key => $value) {
            if (in_array($key, ['instrument', 'user', 'hasToBeChecked']) && $value) {
                $qb->andWhere('i.' . $key . ' = :' . $key);
                $qb->setParameter($key, $value);
            }
            if ($key === 'isAvailable' && $value) {
                $qb = $this->filterIsAvailable($qb);
            }
        }

        if (!empty($params['limit']))
            $qb->setMaxResults($params['limit']);
        if (!empty($params['page']))
            $qb->setFirstResult( ($params['page']-1) * $params['limit']);
        if (!empty($params['order']))
            $qb->orderBy('i.' . array_keys($params['order'])[0], array_values($params['order'])[0]);

        return $count ?
            $qb->getQuery()->getSingleScalarResult()
            : $qb->getQuery()->getResult();
    }

    private function filterIsAvailable ($qb)
    {
        $qb->leftJoin('i.prets', 'p');
        $qb->andWhere('p.id IS NULL OR p.dateDebut > :now OR p.dateFin < :now OR p.dateDebutPrevue > :now');
        $qb->andWhere('i.hasToBeChecked = 0');
        $qb->setParameter('now', new \DateTime('now'));
        // $qb->andWhere('p.dateFin IS NULL OR p.dateFin < NOW()');
        // $qb->groupBy('i.id');
        return $qb;
    }

}
