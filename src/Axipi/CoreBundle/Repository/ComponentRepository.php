<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ComponentRepository extends EntityRepository {
    public function getById($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp');
        $query->from('AxipiCoreBundle:Component', 'cmp');
        $query->where('cmp.id = :id');
        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getRows() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp');
        $query->from('AxipiCoreBundle:Component', 'cmp');

        return $query->getQuery();
    }
}
