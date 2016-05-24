<?php

namespace EcommerceBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FacturesCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('ecommerce:facture')
                ->setDescription('Première commande')
                ->addArgument('date', InputArgument::OPTIONAL, 'Date pour laquelle vous soutez récupérer les factures');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $date = new \DateTime();
        $dateOutput = $input->getArgument('date');

        $em = $this->getContainer()->get('doctrine')->getManager();
        $factures = $em->getRepository('EcommerceBundle:Commandes')->byDateCommand($dateOutput);

        $output->writeln(count($factures) . " facture(s)");

        if (count($factures) > 0) {
//            $dir = __DIR__.'/../../../'.'Factures/' . $date->format('d-m-Y h:i:s');
            $dir = "./Factures/". $date->format('d-m-Y_h:i:s');
//            $dircreate = $date->format('d-m-Y h-i-s');
//            mkdir('Factures/' . $dircreate);
            foreach ($factures as $facture) {
                $path = './Factures/'.$date->format('d-m-Y_h:i:s').'_facture' . $facture->getReference() . '.pdf';
                $this->getContainer('')->get('setNewFacture')->facture($facture)->Output($path, 'F');
            }
        }
    }

}
