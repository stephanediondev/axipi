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

    public function getRows($category = null) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp');
        $query->from('AxipiCoreBundle:Component', 'cmp');

        if($category) {
            $query->where('cmp.category = :category');
            $query->setParameter(':category', $category);
        }

        $query->orderBy('cmp.title');

        return $query->getQuery()->getResult();
    }

    public function getZones() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('zon');
        $query->from('AxipiCoreBundle:Zone', 'zon');

        return $query->getQuery()->getResult();
    }
}
