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

    public function search($params = null, $count = false)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->from('Entity\Pret', 'p');

        if ($count) {
            $qb->select('count(p.id)');
        } else {
            $qb->select('distinct p');
        }

        foreach ($params['filters'] as $key => $value) {
            if (in_array($key, ['instrument', 'user'])) {
                $qb->andWhere('p.' . $key . ' = :' . $key);
                $qb->setParameter($key, $value);
            }
        }

        if (!empty($params['limit']))
            $qb->setMaxResults($params['limit']);
        if (!empty($params['page']))
            $qb->setFirstResult( ($params['page']-1) * $params['limit']);
        if (!empty($params['order']))
            $qb->orderBy('p.' . array_keys($params['order'])[0], array_values($params['order'])[0]);

        return $count ?
            $qb->getQuery()->getSingleScalarResult()
            : $qb->getQuery()->getResult();
    }

}
