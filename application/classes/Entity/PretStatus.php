<?php

namespace Entity;

use Entity\BaseEntity;

class PretStatus extends BaseEntity
{
    const STATUS_AWAITING = 'AWAITING';
    const STATUS_RUNNING  = 'RUNNING';
    const STATUS_CLOSED   = 'CLOSED';
    const STATUS_CANCELED = 'CANCELED';
    const STATUS_MISSING  = 'MISSING';

    public static function calculate ($pret)
    {
        $now = (new \Datetime('now'))->format('Y-m-d\TH:i:sP');

        if ($pret->getDateDebutPrevue() && !$pret->getDateDebut())
            return self::STATUS_AWAITING;
        elseif ($pret->getDateDebut() < $now && $now < $pret->getDateFinPrevue())
            return self::STATUS_RUNNING;
        elseif ($pret->getDateFinPrevue() && $pret->getDateFinPrevue() < $now)
            return self::STATUS_MISSING;
        elseif ($pret->getDateFin() && !$pret->getDateDebut())
            return self::STATUS_CANCELED;
        elseif ($pret->getDateFin())
            return self::STATUS_CLOSED;

        return false;
    }

}
