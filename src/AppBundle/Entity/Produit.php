<?php

namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as ProduitAssert;


/**
 * @UniqueEntity(fields="ref_produit", message="Ce produit existe déjà.")
 * Définit les propriétés d'un produit
 */
class Produit
{
    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *          min = 1, 
     *          max = 255, 
     *          minMessage = "La référence doit contenir au moins {{ limit }} caractère.",
     *          maxMessage = "La référence doit contenir au plus {{ limit }} caractères.")
     */
    private $ref_produit;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *          min = 1, 
     *          max = 255, 
     *          minMessage = "Le champ doit contenir au moins {{ limit }} caractère.",
     *          maxMessage = "Le champ doit contenir au plus {{ limit }} caractères.")
     */
    private $nom_produit;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *          min = 1, 
     *          max = 255, 
     *          minMessage = "Le champ doit contenir au moins {{ limit }} caractère.",
     *          maxMessage = "Le champ doit contenir au plus {{ limit }} caractères.")
     */
    private $description_produit;

    /**
     * @var string
     */
    private $categorie_produit;

    /**
     * @var integer
     *
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.", groups={"stock"})
     * @Assert\GreaterThanOrEqual(value = 0, message = "La valeur doit être supérieure ou égale à 0.", groups={"stock"})
     * @Assert\Length(
     *          min = 1, 
     *          max = 11, 
     *          minMessage = "Le champ doit contenir au moins {{ limit }} caractère.",
     *          maxMessage = "Le champ doit contenir au plus {{ limit }} caractères.", groups={"stock"})
     */
    private $quantite_produit;

    /**
     * @var integer
     *
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.", groups={"stock"})
     * @Assert\GreaterThanOrEqual(value = 0, message = "La valeur doit être supérieure ou égale à 0.", groups={"stock"})
     * @Assert\Length(
     *          min = 1, 
     *          max = 11, 
     *          minMessage = "Le champ doit contenir au moins {{ limit }} caractère.",
     *          maxMessage = "Le champ doit contenir au plus {{ limit }} caractères.", groups={"stock"})
     */
    private $quantite_min_produit;

    /**
     * @var integer
     *
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.")
     * @Assert\GreaterThanOrEqual(value = 0, message = "La valeur doit être supérieure ou égale à 0.")
     * @Assert\Length(
     *          min = 1, 
     *          max = 11, 
     *          minMessage = "Le champ doit contenir au moins {{ limit }} caractère.",
     *          maxMessage = "Le champ doit contenir au plus {{ limit }} caractères.")
     */
    private $prix_produit;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide (utilisez le calendrier).", groups={"stock"})
     * @ProduitAssert\ProchaineDate(groups={"stock"})
     */
    private $date_peremption_produit;

    /**
     * @var string
     *
     * @Assert\Image(mimeTypesMessage = "Le fichier doit être une image.")
     */
    private $photo_produit;

    /**
     * @var boolean
     */
    private $visible_produit;


    /**
     * Set refProduit
     *
     * @param string $refProduit
     *
     * @return Produit
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
     * Set nomProduit
     *
     * @param string $nomProduit
     *
     * @return Produit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nom_produit = $nomProduit;

        return $this;
    }

    /**
     * Get nomProduit
     *
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nom_produit;
    }

    /**
     * Set descriptionProduit
     *
     * @param string $descriptionProduit
     *
     * @return Produit
     */
    public function setDescriptionProduit($descriptionProduit)
    {
        $this->description_produit = $descriptionProduit;

        return $this;
    }

    /**
     * Get descriptionProduit
     *
     * @return string
     */
    public function getDescriptionProduit()
    {
        return $this->description_produit;
    }

    /**
     * Set categorieProduit
     *
     * @param string $categorieProduit
     *
     * @return Produit
     */
    public function setCategorieProduit($categorieProduit)
    {
        $this->categorie_produit = $categorieProduit;

        return $this;
    }

    /**
     * Get categorieProduit
     *
     * @return string
     */
    public function getCategorieProduit()
    {
        return $this->categorie_produit;
    }

    /**
     * Set quantiteProduit
     *
     * @param integer $quantiteProduit
     *
     * @return Produit
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
     * Set quantiteMinProduit
     *
     * @param integer $quantiteMinProduit
     *
     * @return Produit
     */
    public function setQuantiteMinProduit($quantiteMinProduit)
    {
        $this->quantite_min_produit = $quantiteMinProduit;

        return $this;
    }

    /**
     * Get quantiteMinProduit
     *
     * @return integer
     */
    public function getQuantiteMinProduit()
    {
        return $this->quantite_min_produit;
    }

    /**
     * Set prixProduit
     *
     * @param integer $prixProduit
     *
     * @return Produit
     */
    public function setPrixProduit($prixProduit)
    {
        $this->prix_produit = $prixProduit;

        return $this;
    }

    /**
     * Get prixProduit
     *
     * @return integer
     */
    public function getPrixProduit()
    {
        return $this->prix_produit;
    }

    /**
     * Set datePeremptionProduit
     *
     * @param \DateTime $datePeremptionProduit
     *
     * @return Produit
     */
    public function setDatePeremptionProduit($datePeremptionProduit)
    {
        $this->date_peremption_produit = $datePeremptionProduit;

        return $this;
    }

    /**
     * Get datePeremptionProduit
     *
     * @return \DateTime
     */
    public function getDatePeremptionProduit()
    {
        return $this->date_peremption_produit;
    }

    /**
     * Set photoProduit
     *
     * @param string $photoProduit
     *
     * @return Produit
     */
    public function setPhotoProduit($photoProduit)
    {
        $this->photo_produit = $photoProduit;

        return $this;
    }   

    /**
     * Get photoProduit
     *
     * @return string
     */
    public function getPhotoProduit()
    {
        return $this->photo_produit;
    }

    /**
     * Set visibleProduit
     *
     * @param boolean $visibleProduit
     *
     * @return Produit
     */
    public function setVisibleProduit($visibleProduit)
    {
        $this->visible_produit = $visibleProduit;

        return $this;
    }

    /**
     * Get visibleProduit
     *
     * @return boolean
     */
    public function getVisibleProduit()
    {
        return $this->visible_produit;
    }
}

