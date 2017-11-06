<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Identification;

/**
*   Contrôleur en charge des personnes connectés (client et magasinier)
*/
class PersonneController extends Controller
{
    /**
    *   Action qui affiche la liste des personnes créées.
    *
    *   @return La page html.twig de la liste des personnes créées.
    */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personnes = $em->getRepository('AppBundle:Personne')->findAll();

        return $this->render('personne/index.html.twig', array(
            'personnes' => $personnes,
        ));
    }

    /**
     *  Action qui créée une nouvelle personne.
     *
     *  @return La page html.twig du formulaire de création si il n'a pas été soumis.
     *          Sinon, la page html.twig de la liste des personnes créées.
     */
    public function newAction(Request $request)
    {
        $personne = new Personne();
        $form = $this->createForm('AppBundle\Form\Type\PersonneType', $personne, ["method" => 'POST']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush($personne);

            return $this->redirectToRoute('affichePersonne', array('id' => $personne->getIdPersonne()));
        }

        return $this->render('personne/new.html.twig', array(
            'personne' => $personne,
            'form' => $form->createView(),
        ));
    }


    /**
     *  Action qui gère l'affichage du profil d'une personne.
     *
     *  @return La page html.twig du profil d'une personne.
     */
    public function showAction(Personne $personne)
    {
        $deleteForm = $this->createDeleteForm($personne);

        return $this->render('personne/show.html.twig', array(
            'personne' => $personne,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
    *   Action qui gère l'édition du profil d'une personne.
    *
    *   @return La page html.twig d'édition de profil.
    */
    public function editAction(Request $request, Personne $personne)
    {
        $deleteForm = $this->createDeleteForm($personne);
        $editForm = $this->createForm('AppBundle\Form\Type\PersonneType', $personne, ["method" => 'POST']);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personne_edit', array('id' => $personne->getIdPersonne()));
        }

        return $this->render('personne/edit.html.twig', array(
            'personne' => $personne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Personne $personne)
    {
        $form = $this->createDeleteForm($personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($personne);
            $em->flush($personne);
        }

        return $this->redirectToRoute('personne_index');
    }

    private function createDeleteForm(Personne $personne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('affichePersonne', array('id' => $personne->getIdPersonne())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
