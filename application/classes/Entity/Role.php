<?php

namespace Entity;

use Entity\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\RoleRepository")
 * @Table(name="role")
 */
class Role extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", nullable=false, unique=true)
     */
    protected $name;

    /**
     * @Column(type="string", nullable=false, unique=true)
     */
    protected $label;

    /**
     * @ManyToOne(targetEntity="Entity\Role")
     */
    protected $parent;


    public function __construct() {}

    protected $attributes = [
        'id',
        'name',
        'label'
    ];

    protected $relations = [
        'parent'   => self::RELATION_ONE
    ];

    public function toArray(array $with = [])
    {
        $extras = [];
        return array_merge(parent::toArray($with), $extras);
    }

}
