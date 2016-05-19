<?php

namespace EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EcommerceBundle\Entity\Produits;

class ProduitsData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $produit1 = new Produits();
        $produit1->setCategorie($this->getReference('categorie1'));
        $produit1->setDescription("Le poivron rouge est un groupe de cultivars de l'espèce Capsicum annuum.");
        $produit1->setDisponible('1');
        $produit1->setImage($this->getReference('media3'));
        $produit1->setNom('Poivron rouge');
        $produit1->setPrix('1.99');
        $produit1->setTva($this->getReference('tva1'));
        $manager->persist($produit1);

        $produit2 = new Produits();
        $produit2->setCategorie($this->getReference('categorie1'));
        $produit2->setDescription("Piment est généralement associé à la saveur du piquant (pimenté).");
        $produit2->setDisponible('1');
        $produit2->setImage($this->getReference('media4'));
        $produit2->setNom('Piment');
        $produit2->setPrix('3.99');
        $produit2->setTva($this->getReference('tva2'));
        $manager->persist($produit2);

        $produit3 = new Produits();
        $produit3->setCategorie($this->getReference('categorie1'));
        $produit3->setDescription("La tomate est une espèce de plantes herbacées de la famille des Solanacées, originaire du nord-ouest de l'Amérique du Sud.");
        $produit3->setDisponible('1');
        $produit3->setImage($this->getReference('media5'));
        $produit3->setNom('Tomate');
        $produit3->setPrix('0.99');
        $produit3->setTva($this->getReference('tva2'));
        $manager->persist($produit3);

        $produit4 = new Produits();
        $produit4->setCategorie($this->getReference('categorie1'));
        $produit4->setDescription("Le poivron vert est un groupe de cultivars de l'espèce Capsicum annuum.");
        $produit4->setDisponible('1');
        $produit4->setImage($this->getReference('media6'));
        $produit4->setNom('Poivron vert');
        $produit4->setPrix('2.99');
        $produit4->setTva($this->getReference('tva2'));
        $manager->persist($produit4);

        $produit5 = new Produits();
        $produit5->setCategorie($this->getReference('categorie2'));
        $produit5->setDescription("Le raisin est le fruit de la Vigne. Le raisin de la vigne cultivée Vitis vinifera est un des fruits les plus cultivés au monde, avec 68 millions de tonnes produites en 2010.");
        $produit5->setDisponible('1');
        $produit5->setImage($this->getReference('media7'));
        $produit5->setNom('Raisin');
        $produit5->setPrix('0.97');
        $produit5->setTva($this->getReference('tva2'));
        $manager->persist($produit5);

        $produit6 = new Produits();
        $produit6->setCategorie($this->getReference('categorie2'));
        $produit6->setDescription("L’orange est un agrume, fruit des orangers, des arbres de différentes espèces de la famille des Rutacées ou d'hybrides de ceux-ci.");
        $produit6->setDisponible('1');
        $produit6->setImage($this->getReference('media8'));
        $produit6->setNom('Orange');
        $produit6->setPrix('1.20');
        $produit6->setTva($this->getReference('tva2'));
        $manager->persist($produit6);

        
        $produit7 = new Produits();
        $produit7->setCategorie($this->getReference('categorie3'));
        $produit7->setDescription("Les pâtes alimentaires sont des aliments fabriqués à partir d'un mélange pétri de farine, de semoule de blé dur, d'épeautre, de blé noir, de riz ou d'autres types de céréales, d'eau et parfois d'œuf et de sel.");
        $produit7->setDisponible('1');
        $produit7->setImage($this->getReference('media11'));
        $produit7->setNom('pâtes');
        $produit7->setPrix('0.90');
        $produit7->setTva($this->getReference('tva2'));
        $manager->persist($produit7);
        
        
        $produit8 = new Produits();
        $produit8->setCategorie($this->getReference('categorie3'));
        $produit8->setDescription("Le riz est une céréale de la famille des poacées (anciennement graminées), cultivée dans les régions tropicales, subtropicales et tempérées chaudes pour son fruit, ou caryopse, riche en amidon.");
        $produit8->setDisponible('1');
        $produit8->setImage($this->getReference('media12'));
        $produit8->setNom('Riz');
        $produit8->setPrix('0.75');
        $produit8->setTva($this->getReference('tva2'));
        $manager->persist($produit8);
        
        
        $produit9 = new Produits();
        $produit9->setCategorie($this->getReference('categorie3'));
        $produit9->setDescription("La sauce tomate est une sauce salée à base de tomates.");
        $produit9->setDisponible('1');
        $produit9->setImage($this->getReference('media13'));
        $produit9->setNom('Sauce Tomate');
        $produit9->setPrix('1.78');
        $produit9->setTva($this->getReference('tva2'));
        $manager->persist($produit9);
        
        $produit10 = new Produits();
        $produit10->setCategorie($this->getReference('categorie4'));
        $produit10->setDescription("Le beurre est un aliment constitué par la matière grasse du lait seulement travaillée mécaniquement pour améliorer son goût, sa conservation et diversifier ses utilisations, que ce soit nature, notamment en tartine ou comme corps gras de cuisson des aliments, ou ingrédient de préparations culinaires et notamment pâtissières.");
        $produit10->setDisponible('1');
        $produit10->setImage($this->getReference('media14'));
        $produit10->setNom('Beurre');
        $produit10->setPrix('1.52');
        $produit10->setTva($this->getReference('tva2'));
        $manager->persist($produit10);
        
        $produit11 = new Produits();
        $produit11->setCategorie($this->getReference('categorie4'));
        $produit11->setDescription("La crème fraîche, est un produit laitier pasteurisé et maturé, obtenu par écrémage du lait de vache, devant contenir au moins 30 % de matière grasse, et au moins 12 % pour la crème légère fraîche.");
        $produit11->setDisponible('1');
        $produit11->setImage($this->getReference('media15'));
        $produit11->setNom('Crème fraîche');
        $produit11->setPrix('1.40');
        $produit11->setTva($this->getReference('tva2'));
        $manager->persist($produit11);
        
        $produit12 = new Produits();
        $produit12->setCategorie($this->getReference('categorie4'));
        $produit12->setDescription(" fromage est un aliment obtenu à partir de lait coagulé ou de produits laitiers, comme la crème, puis d'un égouttage suivi ou non de fermentation et éventuellement d'affinage (fromages affinés).");
        $produit12->setDisponible('1');
        $produit12->setImage($this->getReference('media16'));
        $produit12->setNom('Fromage');
        $produit12->setPrix('3.10');
        $produit12->setTva($this->getReference('tva2'));
        $manager->persist($produit12);
        
        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }

}
