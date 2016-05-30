<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Item;

class ItemRepository extends EntityRepository {
    public function getById($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Item', 'pge');
        $query->leftJoin('pge.component', 'cmp');
        $query->where('pge.id = :id');

        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getBySlug($slug) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Item', 'pge');
        $query->leftJoin('pge.component', 'cmp');
        if($slug == '') {
            $query->where('pge.slug IS NULL');
        } else {
            $query->where('pge.slug = :slug');
            $query->setParameter(':slug', $slug);
        }

        $query->andWhere('cmp.category = :category');
        $query->setParameter(':category', 'page');

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getRows($language, $parent) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Item', 'pge');
        $query->leftJoin('pge.component', 'cmp');
        $query->leftJoin('pge.language', 'lng');

        $query->where('cmp.category = :category');
        $query->setParameter(':category', 'page');

        $query->andWhere('lng.code = :language');
        $query->setParameter(':language', $language);

        if($parent) {
            $query->andWhere('pge.parent = :parent');
            $query->setParameter(':parent', $parent);
        } else {
            $query->andWhere('pge.parent IS NULL');
        }

        $query->orderBy('pge.slug');

        return $query->getQuery();
    }

    public function getConvertPages($ids) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge');
        $query->from('AxipiCoreBundle:Item', 'pge');
        $query->where('pge.id IN ('.implode(',', $ids).')');

        return $query->getQuery()->getResult();
    }

    public function getLanguages() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('lng');
        $query->from('AxipiCoreBundle:Language', 'lng');

        return $query->getQuery()->getResult();
    }

    public function getComponents($category) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp');
        $query->from('AxipiCoreBundle:Component', 'cmp');
        $query->where('cmp.category = :category');
        $query->andWhere('cmp.isActive = :active');

        $query->setParameter(':category', $category);
        $query->setParameter(':active', 1);

        $query->orderBy('cmp.title');

        return $query->getQuery()->getResult();
    }

    public function getPages(Item $item) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Item', 'pge');
        $query->leftJoin('pge.component', 'cmp');

        if($item->getComponent()->getParent()) {
            $query->where('pge.component = :component_parent');
            $query->setParameter(':component_parent', $item->getComponent()->getParent());
        }

        $query->orderBy('pge.title');

        return $query->getQuery()->getResult();
    }

    public function getPagesWidgetRelated($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('wdg_pge', 'wdg', 'pge');
        $query->from('AxipiCoreBundle:Relation', 'wdg_pge');
        $query->leftJoin('wdg_pge.widget', 'wdg');
        $query->leftJoin('wdg_pge.page', 'pge');
        $query->where('wdg.id = :widget');

        $query->setParameter(':widget', $id);

        $query->orderBy('wdg_pge.ordering');

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

    public function getPagesParent(Item $item) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Item', 'pge');
        $query->leftJoin('pge.component', 'cmp');

        $query->where('pge.language = :language_parent');
        $query->setParameter(':language_parent', $item->getLanguage());

        if($item->getComponent()->getParent()) {
            $query->andWhere('pge.component = :component_parent');
            $query->setParameter(':component_parent', $item->getComponent()->getParent());
        }

        $query->orderBy('pge.title');

        return $query->getQuery()->getResult();
    }
}
