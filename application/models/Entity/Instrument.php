<?php

namespace Entity;

use Entity\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\InstrumentRepository")
 * @Table(name="instrument")
 */
class Instrument extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $modele;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $numeroSerie;

    /**
     * @Column(name="is_available", type="boolean", nullable=false, options={"default" : true})
     */
    protected $isAvailable = true;

    /**
     * @Column(name="has_to_be_checked", type="boolean", nullable=false, options={"default" : false})
     */
    protected $hasToBeChecked = false;

    /**
     * @Column(name="`condition`", type="integer", nullable=true)
     */
    protected $condition;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $comment;

    /**
     * @Column(type="string", length=13, unique=true, nullable=true)
     */
    protected $barcode;

    /**
     * @ManyToOne(targetEntity="Entity\Marque")
     */
    protected $marque;

    /**
     * @ManyToOne(targetEntity="Entity\Storage")
     */
    protected $storage;


    protected $attributes = [
        'id',
        'modele',
        'numeroSerie',
        'isAvailable',
        'hasToBeChecked',
        'condition',
        'comment',
        'barcode'
    ];

    protected $relations = [
        'marque' => self::RELATION_ONE,
        'storage' => self::RELATION_ONE
    ];

    public function toArray(array $with = [])
    {
        $extras = [];
        return array_merge(parent::toArray($with), $extras);
    }

    public function setMarque(Marque $marque)
    {
        $this->marque = $marque;
    }

}
