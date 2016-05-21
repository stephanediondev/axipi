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

        $query->orderBy('zon.code');

        return $query->getQuery();
    }

    public function getWidgets($code) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('wdg', 'zon', 'zon');
        $query->from('AxipiCoreBundle:Widget', 'wdg');
        $query->leftJoin('wdg.component', 'zon');
        $query->leftJoin('wdg.zone', 'zon');
        $query->where('zon.code = :code');
        $query->andWhere('wdg.isActive = :active');

        $query->setParameter(':code', $code);
        $query->setParameter(':active', 1);

        return $query->getQuery()->getResult();
    }
}
