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

    public function search($data = null)
    {
        $qb = $this->buildDefaultQuery();
        if ($data['limit'])
            $qb->setMaxResults($data['limit']);
        if ($data['page'])
            $qb->setFirstResult( ($data['page']-1) * $data['limit']);
        if ($data['order'])
            $qb->orderBy('u.'.$data['order'], 'ASC');
        return $qb->getQuery()->getResult();
    }

}
