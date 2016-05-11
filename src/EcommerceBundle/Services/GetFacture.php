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

    public function facture($facture, $path = null) {

        $html = $this->templating->render('UtilisateursBundle:Default:layout/facturePDF.html.twig', array(
            'facture' => $facture
                )
        );

        if ($path === null) {
            return $this->container->get('knp_snappy.pdf')->getOutputFromHtml($html);
        } else {
            return $this->container->get('knp_snappy.pdf')->generateFromHtml($html, $path);
        }
    }

}
