<?php
namespace Project29k\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class TypeRepository extends EntityRepository {
    public function findOne($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('typ');
        $query->from('CoreBundle:Type', 'typ');
        $query->where('typ.id = :id');
        $query->setParameter(':id', $id);

        return $query->getQuery()->getSingleResult();
    }
    public function getCategories() {
        $choices = array();
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cat');
        $query->from('CoreBundle:Category', 'cat');

        return $query->getQuery()->getResult();
    }
}
