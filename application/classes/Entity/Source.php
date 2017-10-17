<?php

namespace Entity;

use Entity\BaseEntity;

/**
 * @Entity
 * @Table(name="source")
 */
class Source extends BaseEntity
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * @Id
     * @Column(type="integer", name="id", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public static function getGenderList()
    {
        return [
            'Homme' => self::GENDER_MALE,
            'Femme' => self::GENDER_FEMALE,
        ];
    }

}
