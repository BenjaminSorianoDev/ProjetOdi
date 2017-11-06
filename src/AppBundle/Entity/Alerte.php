<?php

namespace AppBundle\Entity;

/**
 * Alerte
 */
class Alerte
{
    /**
     * @var integer
     */
    private $id_alerte;

    /**
     * @var integer
     */
    private $cat_alerte;

    /**
     * @var \DateTime
     */
    private $date_alerte;

    /**
     * @var \AppBundle\Entity\Produit
     */
    private $ref_produit;


    /**
     * Get idAlerte
     *
     * @return integer
     */
    public function getIdAlerte()
    {
        return $this->id_alerte;
    }

    /**
     * Set catAlerte
     *
     * @param integer $catAlerte
     *
     * @return Alerte
     */
    public function setCatAlerte($catAlerte)
    {
        $this->cat_alerte = $catAlerte;

        return $this;
    }

    /**
     * Get catAlerte
     *
     * @return integer
     */
    public function getCatAlerte()
    {
        return $this->cat_alerte;
    }

    /**
     * Set dateAlerte
     *
     * @param \DateTime $dateAlerte
     *
     * @return Alerte
     */
    public function setDateAlerte($dateAlerte)
    {
        $this->date_alerte = $dateAlerte;

        return $this;
    }

    /**
     * Get dateAlerte
     *
     * @return \DateTime
     */
    public function getDateAlerte()
    {
        return $this->date_alerte;
    }

    /**
     * Set refProduit
     *
     * @param \AppBundle\Entity\Produit $refProduit
     *
     * @return Alerte
     */
    public function setRefProduit(\AppBundle\Entity\Produit $refProduit = null)
    {
        $this->ref_produit = $refProduit;

        return $this;
    }

    /**
     * Get refProduit
     *
     * @return \AppBundle\Entity\Produit
     */
    public function getRefProduit()
    {
        return $this->ref_produit;
    }
}

