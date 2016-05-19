<?php

namespace EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EcommerceBundle\Entity\Media;

class MediaData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $media1 = new Media();
        $media1->setPath('http://cp.lakanal.free.fr/exercices/jeux/memory/legumes/legumes.png');
        $media1->setName('Légumes');
        $manager->persist($media1);

        $media2 = new Media();
        $media2->setPath('produits/fruits.jpeg');
        $media2->setName('Fruits');
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setPath('produits/poivron-rouge.jpg');
        $media3->setName('Poivron rouge');
        $manager->persist($media3);

        $media4 = new Media();
        $media4->setPath('produits/piment.png');
        $media4->setName('Piment');
        $manager->persist($media4);

        $media5 = new Media();
        $media5->setPath('produits/tomate.jpg');
        $media5->setName('Tomate');
        $manager->persist($media5);

        $media6 = new Media();
        $media6->setPath('produits/poivron_vert.jpg');
        $media6->setName('Poivron vert');
        $manager->persist($media6);

        $media7 = new Media();
        $media7->setPath('produits/raisin.jpg');
        $media7->setName('Raisin');
        $manager->persist($media7);

        $media8 = new Media();
        $media8->setPath('produits/orange.jpg');
        $media8->setName('Orange');
        $manager->persist($media8);

        $media9 = new Media();
        $media9->setPath('produits/epicerie.png');
        $media9->setName('Epicerie');
        $manager->persist($media9);

        $media10 = new Media();
        $media10->setPath('produits/cremerie.jpg');
        $media10->setName('Cremerie');
        $manager->persist($media10);

        $media11 = new Media();
        $media11->setPath('produits/pates.jpg');
        $media11->setName('Pâtes');
        $manager->persist($media11);

        $media12 = new Media();
        $media12->setPath('produits/riz.jpg');
        $media12->setName('Riz');
        $manager->persist($media12);


        $media13 = new Media();
        $media13->setPath('produits/sauce-tomate.jpg');
        $media13->setName('Sauce tomate');
        $manager->persist($media13);


        $media14 = new Media();
        $media14->setPath('produits/beurre.jpg');
        $media14->setName('Beurre');
        $manager->persist($media14);


        $media15 = new Media();
        $media15->setPath('produits/creme-fraiche.jpg');
        $media15->setName('Crème fraîche');
        $manager->persist($media15);


        $media16 = new Media();
        $media16->setPath('produits/fromage.jpg');
        $media16->setName('Fromage');
        $manager->persist($media16);



        
        
        

        $manager->flush();

        $this->addReference('media1', $media1);
        $this->addReference('media2', $media2);
        $this->addReference('media3', $media3);
        $this->addReference('media4', $media4);
        $this->addReference('media5', $media5);
        $this->addReference('media6', $media6);
        $this->addReference('media7', $media7);
        $this->addReference('media8', $media8);
        $this->addReference('media9', $media9);
        $this->addReference('media10', $media10);
        $this->addReference('media11', $media11);
        $this->addReference('media12', $media12);
        $this->addReference('media13', $media13);
        $this->addReference('media14', $media14);
        $this->addReference('media15', $media15);
        $this->addReference('media16', $media16);
    }

    public function getOrder() {
        return 1;
    }

}
