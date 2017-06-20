<?php

namespace Entity;

use Entity\BaseEntity;
use Entity\PretStatus;
use AppTrait\DatesTrait;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Repository\PretRepository")
 * @Table(name="pret")
 * @HasLifecycleCallbacks
 */
class Pret extends BaseEntity
{

    use DatesTrait;

    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Entity\User", inversedBy="prets")
     */
    protected $user;

    /**
     * @ManyToOne(targetEntity="Entity\Instrument", inversedBy="prets")
     */
    protected $instrument;

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $montantCaution;

    /**
     * @Column(type="boolean", options={"default" : false})
     */
    protected $cautionVersee = false;

    /**
     * @Column(type="boolean", options={"default" : false})
     */
    protected $cautionRendue = false;

    /**
     * @Column(type="datetime", name="date_debut_prevue", nullable=true)
     */
    protected $dateDebutPrevue;

    /**
     * @Column(type="datetime", name="date_debut", nullable=true)
     */
    protected $dateDebut;

    /**
     * @Column(type="datetime", name="date_fin_prevue", nullable=true)
     */
    protected $dateFinPrevue;

    /**
     * @Column(type="datetime", name="date_fin", nullable=true)
     */
    protected $dateFin;

    /**
     * @Column(type="text", nullable=true)
     */
    protected $comment;


    protected $attributes = [
        'id',
        'montantCaution',
        'cautionVersee',
        'cautionRendue',
        'dateDebut',
        'dateDebutPrevue',
        'dateFin',
        'dateFinPrevue',
        'comment'
    ];

    protected $relations = [
        'user'       => self::RELATION_ONE,
        'instrument' => self::RELATION_ONE
    ];

    public function toArray(array $with = [])
    {
        $extras = [
            'status' => $this->getStatus()
        ];
        return array_merge(parent::toArray($with), $extras);
    }

    /**
     * Getters
     */

    public function getUser ()
    {
        return $this->user;
    }

    public function getInstrument ()
    {
        return $this->instrument;
    }

    public function getMontantCaution ()
    {
        return $this->montantCaution;
    }

    public function getCautionVersee ()
    {
        return $this->cautionVersee;
    }

    public function getCautionRendue ()
    {
        return $this->cautionRendue;
    }

    public function getDateDebut()
    {
        return $this->dateDebut ? $this->dateDebut->format('Y-m-d\TH:i:sP') : $this->dateDebut;
    }

    public function getDateDebutPrevue()
    {
        return $this->dateDebutPrevue ? $this->dateDebutPrevue->format('Y-m-d\TH:i:sP') : $this->dateDebutPrevue;
    }

    public function getDateFin()
    {
        return $this->dateFin ? $this->dateFin->format('Y-m-d\TH:i:sP') : $this->dateFin;
    }

    public function getDateFinPrevue()
    {
        return $this->dateFinPrevue ? $this->dateFinPrevue->format('Y-m-d\TH:i:sP') : $this->dateFinPrevue;
    }

    public function getComment ()
    {
        return $this->comment;
    }

    public function getStatus ()
    {
        return PretStatus::calculate($this);
    }

    /**
     * Setters
     */

    public function setUser ($user)
    {
        $this->user = $user;
    }

    public function setInstrument ($instrument)
    {
        $this->instrument = $instrument;
    }

    public function setMontantCaution ($montantCaution)
    {
        $this->montantCaution = $montantCaution;
    }

    public function setCautionVersee ($cautionVersee)
    {
        $this->cautionVersee = $cautionVersee;
    }

    public function setCautionRendue ($cautionRendue)
    {
        $this->cautionRendue = $cautionRendue;
    }

    public function setDateDebutPrevue($date)
    {
        $this->dateDebutPrevue = $date;
    }

    public function setDateDebut($date)
    {
        $this->dateDebut = $date;
    }

    public function setDateFin($date)
    {
        $this->dateFin = $date;
    }

    public function setDateFinPrevue($date)
    {
        $this->dateFinPrevue = $date;
    }

    public function setComment ($comment)
    {
        $this->comment = $comment;
    }

}
