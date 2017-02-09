<?php

namespace Entity;

use Entity\BaseEntity;

/**
 * @Entity (repositoryClass="Repository\PaysRepository")
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
     * @Column(type="string", name="iso_code", length=2, unique=true, nullable=false)
     */
    protected $isoCode;

    /**
     * @Column(type="string", name="nom", length=50, unique=false, nullable=false)
     */
    protected $nom;

    protected $attributes = [
        'id',
        'isoCode',
        'nom'
    ];

    protected $relations = [];

}
