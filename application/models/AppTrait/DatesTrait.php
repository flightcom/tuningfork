<?php

namespace AppTrait;

/**
 * @HasLifecycleCallbacks
 */
trait DatesTrait
{
    /**
     * @Column(type="datetime", name="created_at", nullable=true)
     */
    protected $createdAt;

    /**
     * @Column(type="datetime", name="updated_at", nullable=true)
     */
    protected $updatedAt;

    /**
     * Gets the value of created.
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt() {}

    public function getCreatedAtFormatted($format)
    {
        return $this->createdAt ? $this->createdAt->format($format) : null;
    }

    /**
     * Gets the value of created.
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt() {}


    /**
     * Lifecycle callbacks
     */

    /**
     * @PrePersist
     */
    public function _createdAt_prePersist()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @PreUpdate
     */
    public function __datesTrait_doPreUpdate()
    {
        $this->updatedAt = new \DateTime('now');
    }

}
