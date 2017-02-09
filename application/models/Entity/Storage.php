<?php

namespace Entity;

use Entity\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\StorageRepository")
 * @Table(name="storage")
 */
class Storage extends BaseEntity
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

    /**
     * @OneToOne(targetEntity="Entity\Adresse")
     * @JoinColumn(name="adresse_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $adresse;

    protected $attributes = [
        'id',
        'nom',
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
