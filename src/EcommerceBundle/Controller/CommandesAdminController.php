<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use EcommerceBundle\Entity\Commandes;
use EcommerceBundle\Entity\Produits;
use EcommerceBundle\Entity\UtilisateursAdresses;

class CommandesAdminController extends Controller {

    /**
     * @Route("/admin/commandes" , name="admin_commandes_index")
     */
    public function commandes() {

        $em = $this->getDoctrine()->getManager();
        $commandes = $em->getRepository('EcommerceBundle:Commandes')->findAll();

        return $this->render('EcommerceBundle:Administration:commandes/layout/index.html.twig', array(
                    "commandes" => $commandes,
                        )
        );
    }

    /**
     * @Route("/admin/facture/{id}", name="voir_facture")
     */
    public function voirFactureAction($id) {
        $em = $this->getDoctrine()->getManager();

        $facture = $em->getRepository('EcommerceBundle:Commandes')->find($id);

        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('admin_commandes_index'));
        }


        /* Appel au service de generation de facture en pdf */

        $this->container->get('setNewFacture')->facture($facture)->Output('Facture.pdf');

        $response = new Response();
        $response->headers->set('Content-type', 'application/pdf');

        return $response;
    }

}
