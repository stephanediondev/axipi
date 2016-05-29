<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Page;

class PageRepository extends EntityRepository {
    public function getById($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Page', 'pge');
        $query->leftJoin('pge.component', 'cmp');
        $query->where('pge.id = :id');

        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getBySlug($slug) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Page', 'pge');
        $query->leftJoin('pge.component', 'cmp');
        if($slug == '') {
            $query->where('pge.slug IS NULL');
        } else {
            $query->where('pge.slug = :slug');
            $query->setParameter(':slug', $slug);
        }

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getRows($language, $parent) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Page', 'pge');
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
        $query->from('AxipiCoreBundle:Page', 'pge');
        $query->where('pge.id IN ('.implode(',', $ids).')');

        return $query->getQuery();
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

        $query->setParameter(':category', 'page');
        $query->setParameter(':active', 1);

        $query->orderBy('cmp.title');

        return $query->getQuery()->getResult();
    }

    public function getPages(Page $page) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Page', 'pge');
        $query->leftJoin('pge.component', 'cmp');

        if($page->getComponent()->getParent()) {
            $query->where('pge.component = :component_parent');
            $query->setParameter(':component_parent', $page->getComponent()->getParent());
        }

        $query->orderBy('pge.title');

        return $query->getQuery()->getResult();
    }
}
