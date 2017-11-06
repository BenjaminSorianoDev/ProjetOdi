<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\ProduitType;
use AppBundle\Form\Type\ProduitsInfosType;
use AppBundle\Form\Type\ProduitsStocksType;

use AppBundle\Entity\Produit;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
*   Contrôleur en charge de la gestion des produits.
*/
class ProduitController extends Controller {

    /**
    *   Action qui liste les produits pour le client.
    *
    *   @param $_format : Format de la liste (HTML par défaut).
    *
    *   @return La page html.twig de la liste des produits pour le client.
    */
    public function listProduitAction($message, $_param) {

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository(Produit::class)->findList();

        return $this->render('produits/liste.html.twig', ['produits' => $produits, 'msg' => $message, 'param' => $_param]);
    }

    /**
    *   Action qui liste les produits pour le magasinier.
    *
    *   @param $message : Un message (inutile).
    *
    *   @return La page html.twig de la liste des produits pour le magasinier.
    */
    public function listMagasinierProduitAction($message) {

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository(Produit::class)->findList();

        return $this->render('magasinier/liste_magasinier.html.twig', ['produits' => $produits, 'msg' => $message]);
    }

    /**
    *   Action qui liste les stocks des produits.
    *
    *   @param $_format : Format de la liste (HTML par défaut).
    *   @param $message : Un message (inutile).
    *
    *   @return La page html.twig de la liste des stocks de produits.
    */
    public function listStocksProduitAction($message, $_format) {

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository(Produit::class)->findList();

        $reponse = $this->render('magasinier/stocks.'.$_format.'.twig', ['produits' => $produits, 'msg' => $message]);
        
        if ($_format == 'csv') {

            $reponse->headers->set('Content-Type', 'text/csv; charset=utf-8');
            $reponse->headers->set('Content-Disposition','attachment; filename="stocks.csv"');
        }

        return $reponse;
    }

    /**
    *   Action qui ajoute un produit.
    *
    *   @return La page html.twig du formulaire d'ajout de produit.
    */
    public function addProduitAction(Request $request) {

        // creer le formulaire
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit, ["method" => 'POST']);

        return $this->handleForm($form, $produit, $request, "Ajout", "Ajouter un produit");
    }

    /**
    *   Action qui met à jour les informations des produits.
    *
    *   @param $numero : La référence du produit à mettre à jour.
    *
    *   @return La page html.twig du formulaire des produits.
    */    
    public function updateProduitAction(Request $request, $numero) {

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($numero);
        $form = $this->createForm(ProduitsInfosType::class, $produit, array("method" => 'POST'));

        return $this->handleForm($form, $produit, $request, "Modification", "Modifier un produit");
    }

    /**
    *   Action qui met à jour les stocks des produits.
    *
    *   @param $numero : La référence du produit à mettre à jour.
    *
    *   @return La page html.twig du formulaire des produits.
    */
    public function updateStockProduitAction(Request $request, $numero) {

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($numero);
        $form = $this->createForm(ProduitsStocksType::class, $produit, ["method" => 'POST']);

        return $this->handleForm($form, $produit, $request, "Modif. Stocks", "Modifier le stock d'un produit");
    }

    private function handleForm($form, Produit $produit, Request $request, $titreOnglet, $titre) {
        // Récupérer les données du form quand il est soumis
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                
                $produit = $form->getData();
                
                if ($titreOnglet == "Modification") {

                    $fichier = $produit->getPhotoProduit();

                    if ($fichier != null) {

                        $nomFichier = $this->get('app.file_uploader')->upload($fichier);
                        $produit->setPhotoProduit($nomFichier);
                    }
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($produit);
                $em->flush();

                if ($titreOnglet == "Modif. Stocks") {
                    return $this->redirectToRoute('listeStocksProduit');
                } else {
                    return $this->redirectToRoute('listeMagasinierProduit');
                }
         }
        // formulaire non valide ou 1er acces : afficher le formulaire
        return $this->render('magasinier/form.twig',
                             array('form'=> $form->createView(), 'titreOnglet' => $titreOnglet, 'titre' => $titre)) ;
    }
}
