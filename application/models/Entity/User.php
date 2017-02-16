<?php

namespace Entity;

use Entity\BaseEntity;
// use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity (repositoryClass="Repository\UserRepository")
 * @Table(name="user")
 */
class User extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", name="id", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", name="nom", unique=false, nullable=true)
     */
    protected $nom = null;

    /**
     * @Column(type="string", name="prenom", unique=false, nullable=true)
     */
    protected $prenom = null;

    /**
     * @Column(type="date", name="mdate_naissance", unique=false, nullable=true)
     */
    protected $dateNaissance = null;

    /**
     * @Column(type="string", name="email", unique=true, nullable=true)
     */
    protected $email = null;

    /**
     * @Column(type="string", name="tel", unique=true, nullable=true)
     */
    protected $telephone = null;

    /**
     * @OneToOne(targetEntity="Adresse", cascade={"persist"})
     * @JoinColumn(name="adresse_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $adresse = null;

    /**
     * @Column(type="string", length=60, name="password", unique=false, nullable=true)
     */
    protected $password = null;

    /**
     * @Column(type="boolean", name="is_admin", unique=false, nullable=false)
     */
    protected $isAdmin = false;

    /**
     * @Column(type="text", name="commentaire", unique=false, nullable=true)
     */
    protected $commentaire = null;

    /**
     * @Column(type="integer", name="source", unique=false, nullable=true)
     */
    protected $source = null;

    /**
     * @Column(type="boolean", name="is_confirmed", options={"default" : false})
     */
    protected $isConfirmed = false;

    /**
     * @Column(type="string", name="registration_token", nullable=true)
     */
    protected $registrationToken = null;

    /**
     * @Column(type="date", name="date_inscription", unique=false, nullable=true)
     */
    protected $dateInscription = null;

    /**
     * @Column(type="date", name="date_debut_adhesion", unique=false, nullable=true)
     */
    protected $dateDebutAdhesion = null;

    /**
     * @Column(type="date", name="date_fin_adhesion", unique=false, nullable=true)
     */
    protected $dateFinAdhesion = null;

    /**
     * @Column(type="date", name="date_last_connection", unique=false, nullable=true)
     */
    protected $dateLastConnection = null;

    /**
     * @MOneToMany(targetEntity="Entity\Pret", mappedBy="user")
     */
    protected $prets;


    public static $sourcesList= [
        'bouche à oreille',
        'brochure',
        'facebook',
        'internet',
        'presse'
    ];

    protected $attributes = [
        'id',
        'nom',
        'prenom',
        'dateNaissance',
        'email',
        'telephone',
        'password',
        'isAdmin',
        'commentaire',
        'source',
        'isConfirmed',
        'dateInscription',
        'dateDebutAdhesion',
        'dateFinAdhesion'
    ];

    protected $relations = [
        'adresse' => self::RELATION_ONE,
        'prets' => self::RELATION_MANY
    ];

    public function toArray(array $with = [])
    {
        $extras = [
            'isAdherent' => $this->isAdherent()
        ];

        return array_merge(parent::toArray($with), $extras);
    }

    public function setPassword($password)
    {
        $options = [
            'cost' => '14'
        ];

        $this->password = password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function isAdherent()
    {
        return $this->dateFinAdhesion >= date("Y-m-d H:i:s");
    }

}
