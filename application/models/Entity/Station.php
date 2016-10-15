<?php

namespace Entity;

use Entity\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\StationRepository")
 * @Table(name="station")
 */
class Station extends BaseEntity
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
    protected $name;

    /**
     * @OneToOne(targetEntity="Entity\Adresse")
     * @JoinColumn(name="adresse_id", referencedColumnName="adr_id")
     */
    protected $adresse;

    protected $attributes = [
        'id',
        'name',
    ];

    protected $relations = [
        'adresse' => self::RELATION_ONE
    ];

    public function toArray(array $with = [])
    {
        $extras = [];
        return array_merge(parent::toArray($with), $extras);
    }


}
