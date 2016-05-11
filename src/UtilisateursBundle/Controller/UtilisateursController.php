<?php

namespace UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class UtilisateursController extends Controller {

    /**
     * @Route("/profile/factures", name="factures")
     */
    public function factureAction() {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('EcommerceBundle:Commandes')->byFacture($this->getUser());

        return $this->render('UtilisateursBundle:Default:layout/facture.html.twig', array("factures" => $factures));
    }

    /**
     * @Route("/profile/factures/pdf/{id}", name="facturesPDF")
     */
    public function facturePdfAction($id) {
        $em = $this->getDoctrine()->getManager();

        $facture = $em->getRepository('EcommerceBundle:Commandes')->findOneby(
                array(
                    "utilisateur" => $this->getUser(),
                    "valider" => 1,
                    "id" => $id,
                )
        );

        if (!$facture) {

            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('factures'));
        }

//       return $this->render('UtilisateursBundle:Default:layout/facturePDF.html.twig', array('facture' => $facture));

        /* Appel au service de generation de facture en pdf */
        return new Response(
                $this->container->get('setNewFacture')->facture($facture), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="facture.pdf"'
                )
        );
    }

    /**
     * @Route("/villes/{cp}", name="villes")
     */
    public function villesAction($cp) {
        $em = $this->getDoctrine()->getManager();
        $ville = $em->getRepository('EcommerceBundle:Villes')->findOneBy(array('villeCodePostal' => $cp));

        if ($ville) {
            $villeNom = $ville->getVilleNom();
        } else {
            $villeNom = null;
        }
        
        $response = new JsonResponse();
        return $response->setData(array('ville' => $villeNom));
        
    }

}
