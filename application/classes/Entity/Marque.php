<?php

namespace Entity;

use Entity\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\MarqueRepository")
 * @Table(name="marque")
 */
class Marque extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", unique=true, nullable=false)
     */
    protected $nom;

    protected $attributes = [
        'id',
        'nom',
    ];

    protected $relations = [];

    public function toArray(array $with = [])
    {
        $extras = [];
        return array_merge(parent::toArray($with), $extras);
    }

    public function setNom($nom)
    {
        $this->nom = ucwords($nom);
    }


}
