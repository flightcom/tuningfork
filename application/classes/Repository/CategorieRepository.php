<?php

namespace Repository;

use Entity\Categorie;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository as EntityRepository;

class CategorieRepository extends EntityRepository
{
    public function buildDefaultQuery()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from('Entity\Categorie', 'c');

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
        $qb->where('c.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    public function search($params = null, $count = false)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->from('Entity\Categorie', 'c');

        if ($count) {
            $qb->select('count(c.id)');
        } else {
            $qb->select('distinct c');
        }

        foreach ($params['filters'] as $key => $value) {
            if (in_array($key, ['parent'])) {
                if (is_null($value)) {
                    $qb->andWhere('c.' . $key . ' IS NULL');
                } else {
                    $qb->andWhere('c.' . $key . ' = :' . $key);
                    $qb->setParameter($key, $value);
                }
            } else if (in_array($key, ['nom'])) {
                $qb->andWhere('c.' . $key . ' LIKE :' . $key);
                $qb->setParameter($key, '%' . $value . '%');
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

}
