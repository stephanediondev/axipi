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

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge', 'cmp', 'lng');
        $query->from('AxipiCoreBundle:Item', 'pge');
        $query->leftJoin('pge.component', 'cmp');
        $query->leftJoin('pge.language', 'lng');
        $query->leftJoin('pge.zone', 'zon');

        if(isset($parameters['category']) == 1) {
            $query->andWhere('cmp.category = :category');
            $query->setParameter(':category', $parameters['category']);
        }

        if(isset($parameters['language']) == 1) {
            $query->andWhere('lng.code = :language');
            $query->setParameter(':language', $parameters['language']);
        }

        if(isset($parameters['zone']) == 1) {
            $query->andWhere('zon.code = :zone');
            $query->setParameter(':zone', $parameters['zone']);
        }

        if(isset($parameters['parent_null']) == 1 && $parameters['parent_null'] == true) {
            $query->andWhere('pge.parent IS NULL');
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('pge.isActive = :active');
            $query->setParameter(':active', 1);
        }

        if(isset($parameters['component_parent']) == 1) {
            if($parameters['component_parent']->getComponent()->getParent()) {
                $query->andWhere('pge.component = :component_parent');
                $query->setParameter(':component_parent', $parameters['component_parent']->getComponent()->getParent());
            }
        }

        $query->orderBy('pge.slug');

        return $query->getQuery()->getResult();
    }

    public function getConvertPages($ids) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('pge');
        $query->from('AxipiCoreBundle:Item', 'pge');
        $query->where('pge.id IN ('.implode(',', $ids).')');

        return $query->getQuery()->getResult();
    }
}
