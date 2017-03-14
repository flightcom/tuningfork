<?php

namespace Entity;

use Entity\BaseEntity;

/**
 * @Entity
 * @Table(name="pret_status")
 */
class PretStatus extends BaseEntity
{
    const STATUS_AWAITING = 'AWAITING';
    const STATUS_RUNNING  = 'RUNNING';
    const STATUS_CLOSED   = 'CLOSED';
    const STATUS_CANCELED = 'CANCELED';
    const STATUS_MISSING  = 'MISSING';

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
     * @Column(type="string", nullable=false)
     */
    protected $label;

    /**
     * @OneToMany(targetEntity="Entity\Pret", mappedBy="status")
     */
    protected $prets;


    protected $attributes = [
        'id',
        'name',
        'label'
    ];

    protected $relations = [
        'prets' => self::RELATION_MANY
    ];

    public static function calculate ($pret)
    {
        $now = date('Y-m-d h:i:s');

        if ($pret->getDateDebutPrevue() && !$pret->getDateDebut())
            return self::STATUS_AWAITING;
        elseif ($pret->getDateDebut() < $now && $now < $pret->getDateFinPrevue())
            return self::STATUS_RUNNING;
        elseif ($pret->getDateFinPrevue() && $pret->getDateFinPrevue() < $now)
            return self::STATUS_MISSING;
        elseif ($dateFin)
            return self::STATUS_CLOSED;
        elseif ($pret->getDateFin() && !$pret->getDateDebut())
            return self::STATUS_CANCELED;

        return false;
    }

    public static function calculateStatus ($dateDebutPrevue, $dateDebut, $dateFinPrevue, $dateFin)
    {
        $now = date('Y-m-d h:i:s');

        if ($dateDebutPrevue && !$dateDebut)
            return self::STATUS_AWAITING;
        elseif ($dateDebut < $now && $now < $dateFinPrevue)
            return self::STATUS_RUNNING;
        elseif ($dateFinPrevue && $dateFinPrevue < $now)
            return self::STATUS_MISSING;
        elseif ($dateFin)
            return self::STATUS_CLOSED;
        elseif ($dateFin && !$dateDebut)
            return self::STATUS_CANCELED;

        return false;
    }

}
