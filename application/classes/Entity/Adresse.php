<?php

namespace Entity;

use Entity\BaseEntity;
// use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="adresse")
 */
class Adresse extends BaseEntity
{
    /**
     * @Id
     * @Column(type="integer", name="id", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", name="voie", unique=false, nullable=false)
     */
    protected $voie;

    /**
     * @ManyToOne(targetEntity="Entity\Ville", inversedBy="adresse", cascade={"persist"})
     * @JoinColumn(name="ville_id", referencedColumnName="id", nullable=false)
     */
    protected $ville;

    /**
     * @ManyToOne(targetEntity="Entity\Pays", inversedBy="adresse")
     * @JoinColumn(name="pays_id", referencedColumnName="id", nullable=false)
     */
    protected $pays;

    /**
     * @OneToOne(targetEntity="Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    protected $user;


    protected $attributes = [
        'id',
        'voie'
    ];

    protected $relations = [
        'ville' => self::RELATION_ONE,
        'pays'  => self::RELATION_ONE,
        'user'  => self::RELATION_ONE
    ];

    public function toArray(array $with = [])
    {
        $extras = [
            'formatted' => $this->getFormatted()
        ];
        return array_merge(parent::toArray($with), $extras);
    }

    protected function getFormatted()
    {
        return
            $this->getVoie()
            . ' ' . $this->getVille()->getCodePostal()
            . ' ' . $this->getVille()->getNom()
            . ' ' . $this->getPays()->getNom();
    }


    /**
     * GETTERS
     */

    public function getVoie ()
    {
        return $this->voie;
    }

    public function getVille ()
    {
        return $this->ville;
    }

    public function getPays ()
    {
        return $this->pays;
    }

    public function getUser ()
    {
        return $this->user;
    }

    /**
     * SETTERS
     */

    public function setVoie($voie)
    {
        $this->voie = $voie;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function setPays ($pays)
    {
        $this->pays = $pays;
    }

    public function setUser ($user)
    {
        $this->user = $user;
    }

}
