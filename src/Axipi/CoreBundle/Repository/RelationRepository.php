<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Relation;

class RelationRepository extends EntityRepository
{
    public function getOne($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('rel', 'rel_parent', 'rel_children', 'wdg', 'pge');
        $query->from('AxipiCoreBundle:Relation', 'rel');
        $query->leftJoin('rel.parent', 'rel_parent');
        $query->leftJoin('rel.children', 'rel_children');
        $query->leftJoin('rel.widget', 'wdg');
        $query->leftJoin('rel.page', 'pge');

        if(isset($parameters['id']) == 1) {
            $query->andWhere('rel.id = :id');
            $query->setParameter(':id', $parameters['id']);
        }

        return $query->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('rel', 'rel_parent', 'rel_children', 'wdg', 'pge');
        $query->from('AxipiCoreBundle:Relation', 'rel');
        $query->leftJoin('rel.parent', 'rel_parent');
        $query->leftJoin('rel.children', 'rel_children');
        $query->leftJoin('rel.widget', 'wdg');
        $query->leftJoin('rel.page', 'pge');

        if(isset($parameters['parent_null']) == 1 && $parameters['parent_null'] == true) {
            $query->andWhere('rel.parent IS NULL');
        }

        if(isset($parameters['parent']) == 1) {
            $query->andWhere('rel.parent = :parent');
            $query->setParameter(':parent', $parameters['parent']);
        }

        if(isset($parameters['widget']) == 1) {
            $query->andWhere('rel.widget = :widget');
            $query->setParameter(':widget', $parameters['widget']);
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('rel.isActive = :active');
            $query->andWhere('pge.isActive = :active');
            $query->setParameter(':active', true);
        }

        $query->addOrderBy('rel.ordering');
        $query->addOrderBy('pge.title');

        $getQuery = $query->getQuery();

        if(isset($parameters['active']) == 1 && $parameters['active'] == true && function_exists('apcu_clear_cache')) {
            $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
            $cacheDriver->setNamespace('axipi_relation_');
            $getQuery->setResultCacheDriver($cacheDriver);
            $getQuery->setResultCacheLifetime(86400);
        }
        return $getQuery->getResult();
    }
}
