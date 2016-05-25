<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ZoneRepository extends EntityRepository {
    public function getById($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('zon');
        $query->from('AxipiCoreBundle:Zone', 'zon');
        $query->where('zon.id = :id');
        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getRows() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('zon');
        $query->from('AxipiCoreBundle:Zone', 'zon');

        $query->addOrderBy('zon.ordering');
        $query->addOrderBy('zon.code');

        return $query->getQuery()->getResult();
    }

    public function getWidgets($code) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('wdg', 'cmp', 'zon');
        $query->from('AxipiCoreBundle:Widget', 'wdg');
        $query->leftJoin('wdg.component', 'cmp');
        $query->leftJoin('wdg.zone', 'zon');
        $query->where('zon.code = :code');
        $query->andWhere('wdg.isActive = :active');

        $query->setParameter(':code', $code);
        $query->setParameter(':active', 1);

        return $query->getQuery()->getResult();
    }
}
