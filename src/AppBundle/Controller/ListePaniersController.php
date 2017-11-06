<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use AppBundle\Entity\Panier;
use AppBundle\Entity\Contenir;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Personne;

/**
*	Contrôleur en charge de lister les paniers.
*/
class ListePaniersController extends Controller
{
	/**
	*	Action qui liste les paniers
	*
	*	@return La page html.twig de la liste des paniers créés par le client.
	*/
	public function listPaniersAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $id = $em->getRepository(Personne::class)->getIdSession($user);
		//on cherche tout les paniers du client
		$paniers = $em->getRepository(Panier::class)->findBy(array('id_personne' => $id));


		return $this->render('client/liste_paniers_client.twig',['Panier' => $paniers]);
	}

	/**
	*	Action qui liste les produits se trouvant dans le panier sélectionné.
	*
	*	@param $id_panier : Le panier sélectionné.
	*
	*	@return La page html.twig du contenu du panier client.
	*/
	public function viewPanierAction(Request $request,$id_panier)
	{
		$em = $this->getDoctrine()->getManager();

		//on cherche tout les contenus du panier : id_panier
		$contenir = $em->getRepository(Contenir::class)->findBy(array('id_panier' => $id_panier));
		$panier = $em->getRepository(Panier::class)->findOneBy(array('id_panier' => $id_panier));
		$produit = $em->getRepository(Produit::class)->findAll();

		return $this->render('client/contenu_panier_client.twig',['Contenir' => $contenir, 'Panier' => $panier, 'Produit' => $produit]);
	}

}