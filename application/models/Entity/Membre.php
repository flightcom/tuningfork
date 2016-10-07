<?php

namespace Entity;

use Entity\BaseEntity;
// use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="membre")
 */
class Membre extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", name="membre_id", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", name="membre_genre", unique=false, nullable=true)
     */
    protected $genre = null;

    /**
     * @Column(type="string", name="membre_nom", unique=false, nullable=true)
     */
    protected $nom = null;

    /**
     * @Column(type="string", name="membre_prenom", unique=false, nullable=true)
     */
    protected $prenom = null;

    /**
     * @Column(type="date", name="membre_date_naissance", unique=false, nullable=true)
     */
    protected $dateNaissance = null;

    /**
     * @Column(type="date", name="membre_email", unique=false, nullable=true)
     */
    protected $email = null;

    /**
     * @Column(type="date", name="membre_tel", unique=false, nullable=true)
     */
    protected $telephone = null;

    /**
     * @OneToOne(targetEntity="Adresse")
     * @JoinColumn(name="membre_adr_id", referencedColumnName="adr_id")
     */
    protected $adresse = null;

    /**
     * @Column(type="integer", name="membre_password", unique=false, nullable=true)
     */
    protected $password = null;

    /**
     * @Column(type="integer", name="membre_admin", unique=false, nullable=false)
     */
    protected $admin = 0;

    /**
     * @Column(type="text", name="membre_commentaire", unique=false, nullable=true)
     */
    protected $commentaire = null;

    /**
     * @Column(type="integer", name="membre_cnavc", unique=false, nullable=true)
     */
    protected $source = null;

    /**
     * @Column(type="date", name="membre_date_inscription", unique=false, nullable=true)
     */
    protected $dateInscription = null;

    /**
     * @Column(type="date", name="membre_date_adhesion", unique=false, nullable=true)
     */
    protected $dateAdhesion = null;

    /**
     * @Column(type="date", name="membre_date_last_connection", unique=false, nullable=true)
     */
    protected $dateLastConnection = null;

    public static $sourcesList= [
        'bouche à oreille',
        'brochure',
        'facebook',
        'internet',
        'presse'
    ];


}
