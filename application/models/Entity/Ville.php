<?php

namespace Entity;

use Entity\BaseEntity;

/**
 * @Entity
 * @Table(name="ville")
 */
class Ville extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", name="id", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", name="departement", length=3, unique=false, nullable=true)
     */
    protected $departement = null;

    /**
     * @Column(type="string", name="slug", length=255, unique=true, nullable=true)
     */
    protected $slug = null;

    /**
     * @Column(type="string", name="nom", length=45, unique=false, nullable=true)
     */
    protected $nom = null;

    /**
     * @Column(type="string", name="nom_reel", length=45, unique=false, nullable=true)
     */
    protected $nomReel = null;

    /**
     * @Column(type="string", name="code_postal", length=255, unique=false, nullable=true)
     */
    protected $codePostal = null;

    /**
     * @Column(type="string", name="code_commune", length=5, unique=false, nullable=false)
     */
    protected $codeCommune = '';

    /**
     * @Column(type="float", name="longitude_deg", unique=false, nullable=true)
     */
    protected $longitude = null;

    /**
     * @Column(type="float", name="latitude_deg", unique=false, nullable=true)
     */
    protected $latitude = null;

    protected $attributes = [
        'id',
        'departement',
        'slug',
        'nom',
        'nomReel',
        'codePostal',
        'codeCommune',
        'longitude',
        'latitude'
    ];

    protected $relations = [];

}
