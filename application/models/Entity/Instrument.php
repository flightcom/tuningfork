<?php

namespace Entity;

use Entity\BaseEntity;
use AppTrait\DatesTrait;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\InstrumentRepository")
 * @Table(name="instrument")
 * @HasLifecycleCallbacks
 */
class Instrument extends BaseEntity
{
    use DatesTrait;

    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $model;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $serialNumber;

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
     * @Column(type="text", nullable=true)
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

    /**
     * @OneToMany(targetEntity="Entity\Pret", mappedBy="instrument")
     */
    protected $prets;


    public function __construct()
    {
        $this->prets = new ArrayCollection();
    }

    protected $attributes = [
        'id',
        'model',
        'serialNumber',
        'isAvailable',
        'hasToBeChecked',
        'condition',
        'comment',
        'barcode'
    ];

    protected $relations = [
        'prets'   => self::RELATION_MANY,
        'marque'  => self::RELATION_ONE,
        'storage' => self::RELATION_ONE
    ];

    public function toArray(array $with = [])
    {
        $extras = [];
        return array_merge(parent::toArray($with), $extras);
    }

}
