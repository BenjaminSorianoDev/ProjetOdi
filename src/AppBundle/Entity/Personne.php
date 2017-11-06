<?php

namespace AppBundle\Entity;

/**
 * Personne
 */
class Personne
{
    /**
     * @var integer
     */
    private $id_personne;

    /**
     * @var string
     */
    private $pseudo_personne;

    /**
     * @var string
     */
    private $mdp_personne;

    /**
     * @var string
     */
    private $type_personne;


    /**
     * Get idPersonne
     *
     * @return integer
     */
    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    /**
     * Set pseudoPersonne
     *
     * @param string $pseudoPersonne
     *
     * @return Personne
     */
    public function setPseudoPersonne($pseudoPersonne)
    {
        $this->pseudo_personne = $pseudoPersonne;

        return $this;
    }

    /**
     * Get pseudoPersonne
     *
     * @return string
     */
    public function getPseudoPersonne()
    {
        return $this->pseudo_personne;
    }

    /**
     * Set mdpPersonne
     *
     * @param string $mdpPersonne
     *
     * @return Personne
     */
    public function setMdpPersonne($mdpPersonne)
    {
        $this->mdp_personne = $mdpPersonne;

        return $this;
    }

    /**
     * Get mdpPersonne
     *
     * @return string
     */
    public function getMdpPersonne()
    {
        return $this->mdp_personne;
    }

    /**
     * Set typePersonne
     *
     * @param string $typePersonne
     *
     * @return Personne
     */
    public function setTypePersonne($typePersonne)
    {
        $this->type_personne = $typePersonne;

        return $this;
    }

    /**
     * Get typePersonne
     *
     * @return string
     */
    public function getTypePersonne()
    {
        return $this->type_personne;
    }
    
    public function __toString()
    {
    	return (string) $this->getIdPersonne();
    }
}

