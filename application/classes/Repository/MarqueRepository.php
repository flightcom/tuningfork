<?php

namespace Repository;

use Entity\Station;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository as EntityRepository;

class MarqueRepository extends EntityRepository
{
    public function buildDefaultQuery()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('m')
            ->from('Entity\Marque', 'm');

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
        $qb->where('m.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }


}
