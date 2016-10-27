<?php

namespace Entity;

use Entity\BaseEntity;

/**
 * @Entity
 * @Table(name="message")
 */
class Message extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", name="id", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", name="type", unique=false, nullable=false)
     */
    protected $type;

    /**
     * @Column(type="string", name="name", unique=false, nullable=false)
     */
    protected $name;

    /**
     * @Column(type="string", name="email", unique=false, nullable=false)
     */
    protected $email;

    /**
     * @Column(type="string", name="subject", unique=false, nullable=false)
     */
    protected $subject;

    /**
     * @Column(type="text", name="content", unique=false, nullable=false)
     */
    protected $content;

    /**
     * @Column(type="datetime", name="date", unique=false, nullable=false)
     */
    protected $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    protected $attributes = [
        'id',
        'name',
        'email',
        'content',
        'subject',
    ];

    protected $relations = [];

    public function toArray(array $with = [])
    {
        $extras = [];
        return array_merge(parent::toArray($with), $extras);
    }

}
