<?php

namespace AppBundle\Entity;

/**
 * Contenir
 */
class Contenir
{
    /**
     * @var string
     */
    private $id_panier;

    /**
     * @var string
     */
    private $ref_produit;

    /**
     * @var integer
     */
    private $quantite_produit;

    /**
     * @var \DateTime
     */
    private $date_panier;
    
    /**
     * @var integer
     */
    private $quantite_produit_geree;

    /**
     * Set idPanier
     *
     * @param string $idPanier
     *
     * @return Contenir
     */
    public function setIdPanier($idPanier)
    {
        $this->id_panier = $idPanier;

        return $this;
    }

    /**
     * Get idPanier
     *
     * @return string
     */
    public function getIdPanier()
    {
        return $this->id_panier;
    }

    /**
     * Set refProduit
     *
     * @param string $refProduit
     *
     * @return Contenir
     */
    public function setRefProduit($refProduit)
    {
        $this->ref_produit = $refProduit;

        return $this;
    }

    /**
     * Get refProduit
     *
     * @return string
     */
    public function getRefProduit()
    {
        return $this->ref_produit;
    }

    /**
     * Set quantiteProduit
     *
     * @param integer $quantiteProduit
     *
     * @return Contenir
     */
    public function setQuantiteProduit($quantiteProduit)
    {
        $this->quantite_produit = $quantiteProduit;

        return $this;
    }

    /**
     * Get quantiteProduit
     *
     * @return integer
     */
    public function getQuantiteProduit()
    {
        return $this->quantite_produit;
    }

    /**
     * Set datePanier
     *
     * @param \DateTime $datePanier
     *
     * @return Contenir
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
     * Set quantiteProduitGeree
     *
     * @param integer $quantiteProduitGeree
     *
     * @return Contenir
     */
    public function setQuantiteProduitGeree($quantiteProduitGeree)
    {
    	$this->quantite_produit_geree = $quantiteProduitGeree;
    
    	return $this;
    }
    
    /**
     * Get quantiteProduitGeree
     *
     * @return integer
     */
    public function getQuantiteProduitGeree()
    {
    	return $this->quantite_produit_geree;
    }
    
    
    
    
    
}

