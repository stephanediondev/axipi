<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Comment;

class CommentRepository extends EntityRepository
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
        $query->addSelect('com');
        $query->from('AxipiCoreBundle:Comment', 'com');

        if(isset($parameters['item']) == 1) {
            $query->andWhere('com.item = :item');
            $query->setParameter(':item', $parameters['item']);
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('com.isActive = :active');
            $query->setParameter(':active', true);
        }

        $query->addOrderBy('com.id');

        $getQuery = $query->getQuery();

        if(isset($parameters['active']) == 1 && $parameters['active'] == true && function_exists('apcu_clear_cache')) {
            $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
            $cacheDriver->setNamespace('axipi_comment_');
            $getQuery->setResultCacheDriver($cacheDriver);
            $getQuery->setResultCacheLifetime(86400);
        }
        return $getQuery->getResult();
    }
}
