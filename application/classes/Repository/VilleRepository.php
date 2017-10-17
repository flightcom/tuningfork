<?php

namespace Repository;

use Entity\Ville;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository as EntityRepository;

class VilleRepository extends EntityRepository
{
    public function buildDefaultQuery()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('v')
            ->from('Entity\Ville', 'v');

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
        $qb->where('v.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    public function filter($data, $limit = null)
    {
        $qb = $this->buildDefaultQuery();

        $count = 0;
        foreach ($data as $filter => $value) {
            $qb->{$count ? 'andWhere':'where'}("v.$filter LIKE :$filter");
            $qb->setParameter("$filter", $value .'%');
            $count++;
        }

        $qb->orderBy('v.nomReel', 'asc');
        if ($limit)
            $qb->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }

}
