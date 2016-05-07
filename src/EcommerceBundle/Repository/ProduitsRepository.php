<?php

namespace EcommerceBundle\Repository;

/**
 * ProduitsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitsRepository extends \Doctrine\ORM\EntityRepository {

    
    
    public function findArray($array) {
        $qb = $this->createQueryBuilder('u')
                ->select('u')
                ->where('u.id IN (:array)')
                ->setParameter('array', $array);
        
        return $qb->getQuery()->getResult();
        
    }




    public function byCategorie($id) {
        $qb = $this->createQueryBuilder('u')
                ->select('u')
                ->where('u.categorie = :categorie')
                ->andWhere('u.disponible = 1')
                ->orderBy('u.id')
                ->setParameter('categorie', $id);

        return $qb->getQuery()->getResult();
    }

    public function recherche($chaine) {
        $qb = $this->createQueryBuilder('u')
                ->select('u')
                ->where('u.nom like :chaine')
                ->andWhere('u.disponible = 1')
                ->orderBy('u.id')
                ->setParameter('chaine', '%'.$chaine.'%');
        return $qb->getQuery()->getResult();
    }

}
