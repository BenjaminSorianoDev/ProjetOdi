<?php

namespace AppBundle\Repository;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends \Doctrine\ORM\EntityRepository
{
	public function findList(){
        
        $orderby = array('ref_produit' => 'ASC');
        
        return $this->findBy(array(), $orderby);
    }
}
