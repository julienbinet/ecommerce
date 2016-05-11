<?php

namespace UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UtilisateursAdminController extends Controller {

    /**
     * @Route("/admin/utilisateurs", name="admin_utilisateurs_index")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('UtilisateursBundle:Utilisateurs')->findAll();

        return $this->render('UtilisateursBundle:Administration:utilisateurs/layout/index.html.twig', array("utilisateurs" => $utilisateurs));
    }

    /**
     * @Route("/admin/utilisateurs/{id}/adresses", name="admin_utilisateurs_adresses")
     * @Route("/admin/utilisateurs/{id}/factures", name="admin_utilisateurs_factures")
     */
    public function adressesAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('UtilisateursBundle:Utilisateurs')->find($id);
        $route = $request->get('_route');

        if ($route == "admin_utilisateurs_adresses") {
            return $this->render('UtilisateursBundle:Administration:utilisateurs/layout/adresses.html.twig', array("utilisateur" => $utilisateur));
        } elseif ($route == "admin_utilisateurs_factures") {
            return $this->render('UtilisateursBundle:Administration:utilisateurs/layout/factures.html.twig', array("utilisateur" => $utilisateur));
        } else {
            throw $this->createNotFoundException("la route n'existe pas");
        }
    }

}
