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
     * @Column(type="integer", name="adr_id", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", name="adr_voie", unique=false, nullable=false)
     */
    protected $voie;

    /**
     * @ManyToOne(targetEntity="Entity\Ville", inversedBy="adresse")
     * @JoinColumn(name="ville_id", referencedColumnName="id", nullable=false)
     */
    protected $ville;

    /**
     * @ManyToOne(targetEntity="Entity\Pays", inversedBy="adresse")
     * @JoinColumn(name="pays_id", referencedColumnName="id", nullable=false)
     */
    protected $pays;

    protected $attributes = [
        'id',
        'voie',
    ];

    protected $relations = [
        'ville' => self::RELATION_ONE,
        'pays' => self::RELATION_ONE
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

}
