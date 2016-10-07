<?php

namespace Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\Station;
use Doctrine\ORM\EntityRepository as EntityRepository;

class Station_repository extends EntityRepository
{
    public function buildDefaultQuery()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s')
            ->from($this->stationEntity, 's');

        return $qb;
    }

    public function getAll()
    {
        $qb = $this->_em->createQueryBuilder();

        return new ArrayCollection($qb->getQuery()->getArrayResult());
    }

}
