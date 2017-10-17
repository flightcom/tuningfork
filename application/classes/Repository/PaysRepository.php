<?php

namespace Repository;

use Entity\Pays;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository as EntityRepository;

class PaysRepository extends EntityRepository
{
    public function buildDefaultQuery()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p')
            ->from('Entity\Pays', 'p');

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
        $qb->where('p.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }

}
