<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Widget;

class WidgetRepository extends EntityRepository {
    public function getById($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('wdg', 'cmp', 'zon');
        $query->from('AxipiCoreBundle:Widget', 'wdg');
        $query->leftJoin('wdg.component', 'cmp');
        $query->leftJoin('wdg.zone', 'zon');
        $query->where('wdg.id = :id');

        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getRows() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('wdg', 'cmp', 'zon');
        $query->from('AxipiCoreBundle:Widget', 'wdg');
        $query->leftJoin('wdg.component', 'cmp');
        $query->leftJoin('wdg.zone', 'zon');
        $query->where('cmp.category = :category');

        $query->setParameter(':category', 'widget');

        return $query->getQuery();
    }

    public function getPages($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('wdg_pge', 'wdg', 'pge');
        $query->from('AxipiCoreBundle:WidgetPage', 'wdg_pge');
        $query->leftJoin('wdg_pge.widget', 'wdg');
        $query->leftJoin('wdg_pge.page', 'pge');
        $query->where('wdg.id = :widget');

        $query->setParameter(':widget', $id);

        $query->orderBy('wdg_pge.ordering');

        return $query->getQuery()->getResult();
    }

    public function getLanguages() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('lng');
        $query->from('AxipiCoreBundle:Language', 'lng');

        return $query->getQuery()->getResult();
    }

    public function getComponents() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp');
        $query->from('AxipiCoreBundle:Component', 'cmp');
        $query->where('cmp.category = :category');
        $query->andWhere('cmp.isActive = :active');

        $query->setParameter(':category', 'widget');
        $query->setParameter(':active', 1);

        $query->orderBy('cmp.title');

        return $query->getQuery()->getResult();
    }

    public function getZones() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('zon');
        $query->from('AxipiCoreBundle:Zone', 'zon');

        $query->addOrderBy('zon.ordering');
        $query->addOrderBy('zon.code');

        return $query->getQuery()->getResult();
    }

    public function getPagesParent(Widget $widget) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Page', 'pge');
        $query->leftJoin('pge.component', 'cmp');

        if($widget->getComponent()->getParent()) {
            $query->where('pge.component = :component_parent');
            $query->setParameter(':component_parent', $widget->getComponent()->getParent());
        }

        $query->orderBy('pge.title');

        return $query->getQuery()->getResult();
    }
}
