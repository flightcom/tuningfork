<?php

namespace Repository;

use Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository as EntityRepository;

class UserRepository extends EntityRepository
{
    public function buildDefaultQuery()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from('Entity\User', 'u');

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
        $qb->where('u.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    public function search($params = null, $count = false)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->from('Entity\User', 'u');

        if ($count) {
            $qb->select('count(u.id)');
        } else {
            $qb->select('distinct u');
        }

        foreach ($params['filters'] as $key => $value) {
            $qb->andWhere('u.' . $key . ' = :' . $key);
            $qb->setParameter($key, $value);
        }

        if ($params['limit'])
            $qb->setMaxResults($params['limit']);
        if ($params['page'])
            $qb->setFirstResult( ($params['page']-1) * $params['limit']);
        if (!empty($params['order']))
            $qb->orderBy('u.' . array_keys($params['order'])[0], array_values($params['order'])[0]);

        return $count ?
            $qb->getQuery()->getSingleScalarResult()
            : $qb->getQuery()->getResult();
    }

}
