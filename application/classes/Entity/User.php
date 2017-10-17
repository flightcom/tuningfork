<?php

namespace Entity;

use Entity\BaseEntity;
use Entity\Adresse;
use AppTrait\DatesTrait;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\UserRepository")
 * @Table(name="user")
 * @HasLifecycleCallbacks
 */
class User extends BaseEntity
{
    use DatesTrait;

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
     * @Column(type="datetime", name="date_naissance", unique=false, nullable=true)
     */
    protected $dateNaissance = null;

    /**
     * @Column(type="string", name="email", unique=true, nullable=true)
     */
    protected $email = null;

    /**
     * @Column(type="string", name="phone", unique=true, nullable=true)
     */
    protected $phone = null;

    /**
     * @OneToOne(targetEntity="Entity\Adresse", cascade={"persist"})
     * @JoinColumn(name="adresse_id", referencedColumnName="id")
     */
    protected $adresse = null;

    /**
     * @Column(type="string", length=60, name="password", unique=false, nullable=true)
     */
    protected $password = null;

    /**
     * @Column(type="text", name="comment", unique=false, nullable=true)
     */
    protected $comment = null;

    /**
     * @Column(type="integer", name="source", unique=false, nullable=true)
     */
    protected $source = null;

    /**
     * @Column(type="datetime", name="confirmed_at", nullable=true)
     */
    protected $confirmedAt = null;

    /**
     * @Column(type="string", name="registration_token", nullable=true)
     */
    protected $registrationToken = null;

    /**
     * @Column(type="datetime", name="date_debut_adhesion", nullable=true)
     */
    protected $dateDebutAdhesion = null;

    /**
     * @Column(type="datetime", name="date_fin_adhesion", nullable=true)
     */
    protected $dateFinAdhesion = null;

    /**
     * @Column(type="datetime", name="date_last_connection", nullable=true)
     */
    protected $dateLastConnection = null;

    /**
     * @OneToMany(targetEntity="Entity\Pret", mappedBy="user")
     */
    protected $prets;

    /**
     * @ManyToMany(targetEntity="Entity\Role")
     * @JoinTable(name="user_roles",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $roles;


    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->prets = new ArrayCollection();
    }

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
        'phone',
        // 'password',
        'isAdmin',
        'comment',
        'source',
        'confirmedAt',
        'dateDebutAdhesion',
        'dateFinAdhesion',
        // 'createdAt',
        // 'updatedAt'
    ];

    protected $relations = [
        'adresse' => self::RELATION_ONE,
        'roles' => self::RELATION_MANY,
        'prets' => self::RELATION_MANY
    ];

    public function toArray(array $with = [])
    {
        $extras = [
            'fullName' => $this->prenom . ' ' . $this->nom,
            'isAdmin' => $this->hasRole('admin'),
            'isMembre' => $this->hasRole('membre'),
            'createdAtFormatted' => $this->createdAt ? $this->createdAt->format('Y-m-d') : null,
            'updatedAtFormatted' => $this->updatedAt ? $this->updatedAt->format('d/m/Y à H:i:s') : null
        ];

        return array_merge(parent::toArray($with), $extras);
    }

    /**
     * Getters
     */

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getDateNaissance()
    {
        // return $this->dateNaissance;
        return $this->dateNaissance ? $this->dateNaissance->format('Y-m-d\TH:i:sP') : $this->dateNaissance;
    }

    public function getEmail ()
    {
        return $this->email;
    }

    public function getPhone ()
    {
        return $this->phone;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getPassword ()
    {
        return $this->password;
    }

    public function getComment ()
    {
        return $this->comment;
    }

    public function getConfirmedAt ()
    {
        return $this->confirmedAt;
    }

    public function getRegistrationToken ()
    {
        return $this->registrationToken;
    }

    public function getDateDebutAdhesion ()
    {
        return $this->dateDebutAdhesion;
    }

    public function getDateFinAdhesion ()
    {
        return $this->dateFinAdhesion;
    }

    public function getDateLastConnection ()
    {
        return $this->dateLastConnection;
    }

    public function getPrets()
    {
        return $this->prets;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Setters
     */

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setDateNaissance($date)
    {
        $this->dateNaissance = $date;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setAdresse ($adresse)
    {
        $this->adresse = $adresse;
    }

    public function setPassword($password)
    {
        $options = [
            'cost' => '14'
        ];

        $this->password = password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setConfirmedAt($comfirmationDate)
    {
        $this->comfirmationDate = $comfirmationDate;
    }

    public function setRegistrationToken($registrationToken)
    {
        $this->registrationToken = $registrationToken;
    }

    public function setDateDebutAdhesion($dateDebutAdhesion)
    {
        $this->dateDebutAdhesion = $dateDebutAdhesion;
    }

    public function setDateFinAdhesion($dateFinAdhesion)
    {
        $this->dateFinAdhesion = $dateFinAdhesion;
    }

    public function setDateLastConnection($dateLastConnection)
    {
        $this->dateLastConnection = $dateLastConnection;
    }

    public function setPrets($prets)
    {
        $this->prets = new ArrayCollection($prets);
    }

    public function setRoles($roles)
    {
        $this->roles = new ArrayCollection($roles);
    }


    /**
     * Doctrine special functions
     * for hydration
     */

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
    /////////// ROLES ////////////
    //////////////////////////////
    public function addRole($role)
    {
        $this->roles->add($role);
    }

    public function addRoles($roles)
    {
        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    public function removeRole($role)
    {
        $this->roles->removeElement($role);
    }

    public function removeRoles($roles)
    {
        foreach ($roles as $role) {
            $this->removeRole($role);
        }
    }

    public function hasRole($roleName)
    {
        foreach ($this->getRoles() as $role) {
            if (strcmp($role->getName(), $roleName) === 0) {
                return true;
            }
        }

        return false;
    }

    public function isMembre()
    {
        return $this->hasRole('membre');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }


    /**
     * @PrePersist
     */
    public function __do_prePersist ()
    {
        $this->setRegistrationToken(\Utils::generateToken());
    }

}
