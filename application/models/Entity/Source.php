<?php

namespace Entity;

use Entity\BaseEntity;

/**
 * @Entity
 * @Table(name="membre")
 */
class Source extends BaseEntity
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    public static function getGenderList()
    {
        return [
            'Homme' => self::GENDER_MALE,
            'Femme' => self::GENDER_FEMALE,
        ];
    }

}
