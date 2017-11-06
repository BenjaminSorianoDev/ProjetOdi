<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Panier;
use AppBundle\Entity\Contenir;
use AppBundle\Entity\Produit; 

/**
*	Contrôleur en charge de la gestion des paniers pour un magasinier.
*/
class GestionPaniersMagasinierController extends Controller 
{
	/**
	*	Action qui liste les paniers validés par l'utilisateur.
	*
	*	@return La page html.twig de la liste des paniers validés.
	*/
	public function listPaniersAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		
		//on cherche tout les paniers du valides par les clients 
		$paniers = $em->getRepository(Panier::class)->findBy(array('etat_panier' => '2'));
		
		return $this->render('magasinier/liste_paniers_magasinier.twig',['Panier' => $paniers]);
	}
	
	/**
	*	Action qui gère un panier sélectionné par le magasinier.
	*
	*	@param $id_panier : L'identifiant du panier à gérer.
	*
	*	@return La page html.twig de gestion des paniers par le magasinier.
	*/
	public function gestionPanierAction(Request $request,$id_panier)
	{
		$em = $this->getDoctrine()->getManager();
	
		//on cherche tout les contenus du panier : id_panier
		$contenir = $em->getRepository(Contenir::class)->findBy(array('id_panier' => $id_panier));
		$panier = $em->getRepository(Panier::class)->findOneBy(array('id_panier' => $id_panier));
		$produit = $em->getRepository(Produit::class)->findAll();
		
		$alertStock = false;
		$alertTropProduits = false;
		$alertNeg = false;
		return $this->render('magasinier/gestion_panier_magasinier.twig',['Contenir' => $contenir, 'Panier' => $panier, 'Produit' => $produit, 'alertStock' => $alertStock, 'alertTropProduits' => $alertTropProduits, 'alertNeg' => $alertNeg]);
	}
	
	/**
	*	Action qui gère la quantité de produit pouvant être distribuée dans le panier à gérer.
	*
	*	@param $ref : La référence du produit.
	*	@param $id_panier : L'identifiant du panier à gérer.
	*	@param $qtt : La quantité du produit à distribuer dans le panier.
	*
	*	@return La page html.twig de la gestion des paniers par le magasinier.
	*/
	public function gestionPanierProduitAction(Request $request, $ref, $id_panier, $qtt){
		$em = $this->getDoctrine()->getManager();
		
		//alertes non affichées de base
		$alertStock = false;
		$alertTropProduits = false;
		$alertNeg = false;
		
		//on recupere le produit et l'objet contenir
		$qttStock = $em->getRepository(produit::class)->findOneBy(array('ref_produit' => $ref))->getQuantiteProduit();
		$contenir = $em->getRepository(Contenir::class)->findOneBy(array('id_panier' => $id_panier, 'ref_produit' => $ref));
		$produit = $em->getRepository(produit::class)->findOneBy(array('ref_produit' => $ref));
		
		//on vérifie les alertes
		if($qtt < 0){
			$alertNeg = true;
		}
		else if($qttStock < $qtt){
			$alertStock = true;
		}
		else if(($contenir->getQuantiteProduit()-$contenir->getQuantiteProduitGeree()) < $qtt){
			$alertTropProduits = true;
		}
		else{
			//on modifie les qtt 
			$qttContenir= $contenir->getQuantiteProduitGeree() + $qtt;
			$contenir->setQuantiteProduitGeree($qttContenir);
			
			$qttProduit = $produit->getQuantiteProduit() - $qtt;
			$produit->setQuantiteProduit($qttProduit);
	
			$em->persist($contenir);
			$em->persist($produit);
			$em->flush();
		}
		
		//on recharge les variables pour les envoyer a la vue
		$contenir = $em->getRepository(Contenir::class)->findBy(array('id_panier' => $id_panier));
		$panier = $em->getRepository(Panier::class)->findOneBy(array('id_panier' => $id_panier));
		$produit = $em->getRepository(Produit::class)->findAll();
		
		return $this->render('magasinier/gestion_panier_magasinier.twig',['Contenir' => $contenir, 'Panier' => $panier, 'Produit' => $produit, 'alertStock' => $alertStock, 'alertTropProduits' => $alertTropProduits, 'alertNeg' => $alertNeg]);
	}
	
	/**
	*	Action qui gère la validation d'un panier par le magasinier.
	*
	*	@param $id_panier : L'identifiant du panier à valider.
	*
	*	@return La page html.twig de la liste des paniers validés par le client.
	*/
	public function gestionPanierValiderAction(Request $request, $id_panier){
		
		$em = $this->getDoctrine()->getManager();
		
		$panier = $em->getRepository(Panier::class)->findOneBy(array('id_panier' => $id_panier));
		$panier->setEtatPanier(3);//1=encours 2=validé par client 3=traité
		$em->persist($panier);
		$em->flush();
		
		//on retourne a la liste de paniers a gerer
		$paniers = $em->getRepository(Panier::class)->findBy(array('etat_panier' => '2'));
		
		return $this->render('magasinier/liste_paniers_magasinier.twig',['Panier' => $paniers]);
	}

}