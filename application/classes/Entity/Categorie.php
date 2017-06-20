<?php

namespace Entity;

use Entity\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\CategorieRepository")
 * @Table(name="categorie")
 * @HasLifecycleCallbacks
 */
class Categorie extends BaseEntity
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
    protected $slug;

    /**
     * @Column(type="string", nullable=false)
     */
    protected $nom;

    /**
     * @ManyToOne(targetEntity="Entity\Categorie", cascade={"persist"})
     */
    protected $parent;


    protected $attributes = [
        'id',
        'slug',
        'nom',
    ];

    protected $relations = [
        'parent' => self::RELATION_ONE
    ];

    public function toArray(array $with = [])
    {
        $extras = [];
        return array_merge(parent::toArray($with), $extras);
    }


    //////////////////////////////
    ////////// GETTERS ///////////
    //////////////////////////////

    public function getNom ()
    {
        return $this->nom;
    }

    public function getSlug ()
    {
        return $this->slug;
    }

    public function getParent ()
    {
        return $this->parent;
    }

    //////////////////////////////
    ////////// SETTERS ///////////
    //////////////////////////////

    public function setNom ($nom)
    {
        $this->nom = ucwords($nom);
    }

    // public function setSlug ($slug)
    // {
    //     $this->slug = $slug;
    // }

    public function setParent ($parent)
    {
        $this->parent = $parent;
    }

    //////////////////////////////
    /////////// HOOKS ////////////
    //////////////////////////////

    /**
     * @PrePersist
     * @PreUpdate
     */
    public function __slug_doPreUpdate ()
    {
        $this->slug = $this->buildSlug($this);
    }

    protected function buildSlug ($categorie)
    {
        return ($categorie->getParent() ? $this->buildSlug($categorie->getParent()) . '-' : '') . \Utils::slugify($categorie->getNom());
    }

}
