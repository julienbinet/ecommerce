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
            $dir = '/var/www/html/Dev/ecommerce/Factures/' . $date->format('d-m-Y h:i:s');
            foreach ($factures as $facture) {
                $path = $dir.'/facture' . $facture->getReference() . '.pdf';
                $this->getContainer('')->get('setNewFacture')->facture($facture, $path);
            }
        }
    }

}
