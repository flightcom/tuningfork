<?php

namespace Entity;

use Entity\BaseEntity;

/**
 * @Entity
 * @Table(name="pays")
 */
class Pays extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", name="id", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", name="nom", length=50, unique=false, nullable=false)
     */
    protected $nom;

    protected $attributes = [
        'id',
        'nom'
    ];

    protected $relations = [];

}
