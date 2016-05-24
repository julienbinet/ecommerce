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

        $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('Ecommerce');
        $html2pdf->pdf->SetTitle('Facture ' . $facture->getReference());
        $html2pdf->pdf->SetSubject('Facture ecommerce');
        $html2pdf->pdf->SetKeywords('facture,ecommerce');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);

        return $html2pdf;
    }

}
