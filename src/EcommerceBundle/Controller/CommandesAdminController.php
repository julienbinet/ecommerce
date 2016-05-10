<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

}
