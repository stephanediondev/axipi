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
        $query->where('pge.slug = :slug');

        $query->setParameter(':slug', $slug);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getRows() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp');
        $query->from('AxipiCoreBundle:Page', 'pge');
        $query->leftJoin('pge.component', 'cmp');
        $query->where('cmp.category = :category');

        $query->setParameter(':category', 'page');

        $query->orderBy('pge.slug');

        return $query->getQuery();
    }

    public function getPrograms() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('prg', 'lng', 'cou');
        $query->from('AxipiCoreBundle:Program', 'prg');
        $query->leftJoin('prg.language', 'lng');
        $query->leftJoin('prg.country', 'cou');

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
