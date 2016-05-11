<?php

namespace EcommerceBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

class GetFacture {

    public function __construct(ContainerInterface $container, EngineInterface $templating) {
        $this->container = $container;
        $this->templating = $templating;
    }

    public function facture($facture) {

        $html = $this->templating->render('UtilisateursBundle:Default:layout/facturePDF.html.twig', array(
            'facture' => $facture
                )
        );

//        var_dump($this->container->get('knp_snappy.pdf')->getOutputFromHtml($html));
//        die('o');
        return new Response(
                $this->container->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="facture.pdf"'
                )
        );
    }

}
