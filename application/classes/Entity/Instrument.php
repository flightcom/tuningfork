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
    protected $storage = null;

    /**
     * @OneToMany(targetEntity="Entity\Pret", mappedBy="instrument")
     */
    protected $prets;

    /**
     * @ManyToMany(targetEntity="Entity\Categorie", cascade={"persist"})
     * @JoinTable(name="instrument_categorie",
     *      joinColumns={@JoinColumn(name="instrument_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@JoinColumn(name="categorie_id", referencedColumnName="id")}
     * )
     */
    protected $categories;


    public function __construct()
    {
        $this->prets = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    protected $attributes = [
        'id',
        'model',
        'serialNumber',
        'hasToBeChecked',
        'condition',
        'comment',
        'barcode'
    ];

    protected $relations = [
        'prets'      => self::RELATION_MANY,
        'marque'     => self::RELATION_ONE,
        'storage'    => self::RELATION_ONE,
        'categories' => self::RELATION_MANY
    ];

    public function toArray(array $with = [])
    {
        $extras = [
            'isAvailable' => $this->isAvailable()
        ];
        return array_merge(parent::toArray($with), $extras);
    }


    //////////////////////////////
    ////////// GETTERS ///////////
    //////////////////////////////

    public function getPrets()
    {
        return $this->prets;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    public function getHasToBeChecked()
    {
        return $this->hasToBeChecked;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getBarcode()
    {
        return $this->barcode;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function getStorage()
    {
        return $this->storage;
    }

    //////////////////////////////
    ////////// SETTERS ///////////
    //////////////////////////////

    public function setPrets($prets)
    {
        $this->prets = new ArrayCollection($prets);
    }

    public function setCategories($categories)
    {
        $this->categories = new ArrayCollection($categories);
    }

    public function setCondition($condition)
    {
        $this->condition = $condition;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }

    public function setHasToBeChecked($hasToBeChecked)
    {
        $this->hasToBeChecked = $hasToBeChecked;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    public function setStorage($storage)
    {
        $this->storage = $storage;
    }

    //////////////////////////////
    /////////// PRETS ////////////
    //////////////////////////////

    public function addPret($pret)
    {
        $this->prets->add($pret);
    }

    public function addPrets($prets)
    {
        foreach ($prets as $pret) {
            $this->addPret($pret);
        }
    }

    public function removePret($pret)
    {
        $this->prets->removeElement($pret);
    }

    public function removePrets($prets)
    {
        foreach ($prets as $pret) {
            $this->removePret($pret);
        }
    }


    //////////////////////////////
    //////// CATEGORIES //////////
    //////////////////////////////

    public function addCategorie($categorie)
    {
        $this->categories->add($categorie);
    }

    public function addCategories($categories)
    {
        foreach ($categories as $categorie) {
            $this->addCategorie($categorie);
        }
    }

    public function removeCategorie($categorie)
    {
        $this->categories->removeElement($categorie);
    }

    public function removeCategories($categories)
    {
        foreach ($categories as $categorie) {
            $this->removeCategorie($categorie);
        }
    }

    //////////////////////////////
    ///// PROCESSED VALUES ///////
    //////////////////////////////

    private function isAvailable ()
    {
        if ($this->getHasToBeChecked())
            return false;
        foreach ($this->getPrets() as $pret) {
            if ($pret->getStatus() === PretStatus::STATUS_RUNNING) {
                return false;
            }
        }

        return true;
    }


}
