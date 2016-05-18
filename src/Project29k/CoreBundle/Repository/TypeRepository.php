<?php
namespace Project29k\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class TypeRepository extends EntityRepository {
    public function findOne($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('typ', 'cat');
        $query->from('CoreBundle:Type', 'typ');
        $query->leftJoin('typ.category', 'cat');
        $query->where('typ.id = :id');
        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getIndex() {
        $choices = array();
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('typ', 'cat');
        $query->from('CoreBundle:Type', 'typ');
        $query->leftJoin('typ.category', 'cat');

        return $query->getQuery();
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
