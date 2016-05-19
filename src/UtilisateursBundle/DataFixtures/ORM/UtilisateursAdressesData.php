<?php

namespace UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EcommerceBundle\Entity\UtilisateursAdresses;

class UtilisateursAdressesData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $adresse1 = new UtilisateursAdresses();
        $adresse1->setUtilisateur($this->getReference('utilisateur1'));
        $adresse1->setNom('Binet');
        $adresse1->setPrenom('Julien');
        $adresse1->setTelephone('0640506015');
        $adresse1->setAdresse('1 grande Rue');
        $adresse1->setCp('92310');
        $adresse1->setPays('France');
        $adresse1->setVille('Sèvres');
        $adresse1->setComplement('4ème étage');
        $manager->persist($adresse1);

        $adresse2 = new UtilisateursAdresses();
        $adresse2->setUtilisateur($this->getReference('utilisateur1'));
        $adresse2->setNom('Binet');
        $adresse2->setPrenom('Jean');
        $adresse2->setTelephone('0660857495');
        $adresse2->setAdresse('3 impasse la mairie');
        $adresse2->setCp('27800');
        $adresse2->setPays('France');
        $adresse2->setVille('Harcourt');
        $adresse2->setComplement('');
        $manager->persist($adresse2);

        $adresse3 = new UtilisateursAdresses();
        $adresse3->setUtilisateur($this->getReference('utilisateur6'));
        $adresse3->setNom('Dupond');
        $adresse3->setPrenom('Martin');
        $adresse3->setTelephone('0232356847');
        $adresse3->setAdresse('1 rue de l\église');
        $adresse3->setCp('75000');
        $adresse3->setPays('France');
        $adresse3->setVille('Paris');
        $adresse3->setComplement('face à la tour Eiffel');
        $manager->persist($adresse3);

        $adresse4 = new UtilisateursAdresses();
        $adresse4->setUtilisateur($this->getReference('utilisateur7'));
        $adresse4->setNom('Admin');
        $adresse4->setPrenom('test');
        $adresse4->setTelephone('0286248847');
        $adresse4->setAdresse('1 rue des champs');
        $adresse4->setCp('75000');
        $adresse4->setPays('France');
        $adresse4->setVille('Paris');
        $adresse4->setComplement('');
        $manager->persist($adresse4);


        $manager->flush();
    }

    public function getOrder() {
        return 6;
    }

}
