<?php
// fichier src/AppBundle/Controller/SecurityController.php
namespace AppBundle\Controller;

use AppBundle\Form\Type\IdentificationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Personne;
use AppBundle\Entity\Identification;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // login demandé par un utilisateur authentifié => rediriger vers home
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('home');
        }
        
        // si le formulaire a été soumis et que l'authentification a échoué
        // récupérer les infos avec le composant AuthenticationUtils
        $echec = $this->get('security.authentication_utils');
        $erreur = $echec->getLastAuthenticationError(); // message d'échec
        $login = $echec->getLastUsername(); // login utilisé lors de l'échec

        // la vue login.html.twig affiche le formulaire ainsi que
        // le login précédemment utilisé et le message d'erreur si le
        // formulaire est affiché après un échec de login
        return $this->render('security/login.html.twig',
                                array( 'login' => $login,
                                       'erreur' => $erreur
                                     )
                            );
    }
}