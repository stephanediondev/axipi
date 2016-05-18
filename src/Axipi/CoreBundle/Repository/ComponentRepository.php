<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class ComponentRepository extends EntityRepository {
    public function findOne($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('typ');//, 'cat'
        $query->from('AxipiCoreBundle:Component', 'typ');
        //$query->leftJoin('typ.category', 'cat');
        $query->where('typ.id = :id');
        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getIndex() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('typ');
        $query->from('AxipiCoreBundle:Component', 'typ');

        return $query->getQuery();
    }

    public function getCategories() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cat');
        $query->from('CoreBundle:Category', 'cat');

        return $query->getQuery()->getResult();
    }
}
