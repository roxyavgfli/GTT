<?php

namespace main\dbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Societe
 */
class Societe {

    /**
     * @var string
     */
    private $nom;

    /**
     * @var boolean
     */
    private $actif;

    /**
     * @var integer
     */
    private $id;

    /**
     * Set id
     * 
     * @param integer $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * set id and updating dependencies
     * @param Integer $id
     * @param EntityManager $em
     */
    public function setIdWithDependency($id, $em) {
        $oldId = $this->getId();
        $this->setId($id);
        $raws = $em->getRepository('maindbBundle:Service')->findBy(Array('societeId' => $oldId));
        foreach ($raws as $raw) {
            $raw->setSocieteId($id);
            $em->persist($raw);
            $em->flush();
        }
        $em->persist($this);
        $metadata = $em->getClassMetaData(get_class($this));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $em->flush();
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Societe
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Societe
     */
    public function setActif($actif) {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif() {
        return $this->actif;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

}
