<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use AppBundle\Entity\Panier;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Personne;
use AppBundle\Entity\Contenir;

/**
*	Contrôleur en charge de la création des paniers.
*/
class CreationPanierController extends Controller
{
	/**
	*	Action qui mène à la création des paniers client.
	*
	*	@return La page html.twig de création de panier.
	*/
	public function indexAction(Request $request)
	{
		return $this->render('client/creation_panier_client.twig');
	}

	/**
	*	Action qui créée un nouveau panier ou récupère celui non validé.
	*
	*	@return La page html.twig de sélection des produits.
	*/
	public function newPanierAction(Request $request)
	{
		$panierEnCours = false;
		$em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $id = $em->getRepository(Personne::class)->getIdSession($user);

		//on cherche tout le dernier panier du client ou on en crée un autre (methode dans le repository)
		$panier = $em->getRepository(Panier::class)->panierEnCours($request,$id);

		//liste des produits
		$produit = $em->getRepository(Produit::class)->findAll();
		//lises des produits du panier
		$contenir = $em->getRepository(Contenir::class)->findBy(array('id_panier' => $panier->getIdPanier()));

		return $this->render('client/achat_client.twig',['Panier' => $panier, 'Produit' => $produit, 'Contenir' => $contenir]);
	}

	/**
	*	Action qui ajoute un produit au panier.
	*
	*	@param $ref : La référence du produit.
	*	@param $id_panier : L'identifiant du panier concerné.
	*	@param $qtt : La quantité du produit sélectionné.
	*
	*	@return La page html.twig de sélection des produits.
	*/
	public function addToPanierAction(Request $request, $ref, $id_panier, $qtt){
		$em = $this->getDoctrine()->getManager();

		//on cherche si deja present dans le panier
		$dejaContenu = $em->getRepository(Contenir::class)->findOneBy(array('id_panier' => $id_panier, 'ref_produit' => $ref));

		//si non on cree un nouveau contenu, sinon on modifie la qtt
		if($dejaContenu == null){
			//on cree un nouveau "contenu" et on remplit ses attributs
			$contenir = new Contenir();
			$contenir->setIdPanier($id_panier);
			$contenir->setRefProduit($ref);
			$contenir->setQuantiteProduit($qtt);
			$date = new \DateTime('now');
			$contenir->setDatePanier($date);
		}
		else{
			$contenir = $dejaContenu;
			$qttFinale = $qtt + $contenir->getQuantiteProduit();
			$contenir->setQuantiteProduit($qttFinale);
		}


		// enregistrer les donnees dans la base
		$em->persist($contenir);
		$em->flush();


		$contenir = $em->getRepository(Contenir::class)->findBy(array('id_panier' => $id_panier));
		$produit = $em->getRepository(Produit::class)->findAll();
		$panier = $em->getRepository(Panier::class)->findOneBy(array('id_panier' => $id_panier));

		return $this->render('client/achat_client.twig',['Panier' => $panier, 'Produit' => $produit, 'Contenir' => $contenir]);
	}

	/**
	*	Action de suppression du panier.
	*
	*	@param $id_panier : L'identifiant du panier à supprimer.
	*
	*	@return La page html.twig de création de panier.
	*/
	public function delPanierAction(Request $request, $id_panier){
		$em = $this->getDoctrine()->getManager();
		$panier = $em->getRepository(Panier::class)->findOneBy(array('id_panier' => $id_panier));
		$em->remove($panier);
		$em->flush();
		return $this->render('client/creation_panier_client.twig');
	}

	/**
	*	Action de validation du panier.
	*
	*	@param $id_panier : L'identifiant du panier à valider.
	*
	*	@return La page html.twig de la liste des paniers.
	*/
	public function validatePanierAction(Request $request, $id_panier){
		$em = $this->getDoctrine()->getManager();
		$panier = $em->getRepository(Panier::class)->findOneBy(array('id_panier' => $id_panier));
		$panier->setEtatPanier(2);//1=encours 2=valide
		$em->flush();

        $user = $this->getUser();

        $id = $em->getRepository(Personne::class)->getIdSession($user);

		//on cherche tout les paniers du client
		$paniers = $em->getRepository(Panier::class)->findBy(array('id_personne' => $id));

		return $this->render('client/liste_paniers_client.twig',['Panier' => $paniers]);
	}


}