<?php

namespace AppBundle\Entity;

/**
 * Panier
 */
class Panier
{
    /**
     * @var integer
     */
    private $id_panier;

    /**
     * @var integer
     */
    private $etat_panier;

    /**
     * @var \DateTime
     */
    private $date_panier;

    /**
     * @var \AppBundle\Entity\Personne
     */
    private $id_personne;


    /**
     * Get idPanier
     *
     * @return integer
     */
    public function getIdPanier()
    {
        return $this->id_panier;
    }

    /**
     * Set etatPanier
     *
     * @param integer $etatPanier
     *
     * @return Panier
     */
    public function setEtatPanier($etatPanier)
    {
        $this->etat_panier = $etatPanier;

        return $this;
    }

    /**
     * Get etatPanier
     *
     * @return integer
     */
    public function getEtatPanier()
    {
        return $this->etat_panier;
    }

    /**
     * Set datePanier
     *
     * @param \DateTime $datePanier
     *
     * @return Panier
     */
    public function setDatePanier($datePanier)
    {
        $this->date_panier = $datePanier;

        return $this;
    }

    /**
     * Get datePanier
     *
     * @return \DateTime
     */
    public function getDatePanier()
    {
        return $this->date_panier;
    }

    /**
     * Set idPersonne
     *
     * @param \AppBundle\Entity\Personne $idPersonne
     *
     * @return Panier
     */
    public function setIdPersonne(\AppBundle\Entity\Personne $idPersonne = null)
    {
        $this->id_personne = $idPersonne;

        return $this;
    }

    /**
     * Get idPersonne
     *
     * @return \AppBundle\Entity\Personne
     */
    public function getIdPersonne()
    {
        return $this->id_personne;
    }
    
    public function __toString()
    {
    	return (string) $this->getIdPersonne();
    }
}

