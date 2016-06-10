<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Relation;

class RelationRepository extends EntityRepository
{
    public function getOne($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('rel', 'wdg', 'pge');
        $query->from('AxipiCoreBundle:Relation', 'rel');
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
        $query->addSelect('rel', 'wdg', 'pge');
        $query->from('AxipiCoreBundle:Relation', 'rel');
        $query->leftJoin('rel.widget', 'wdg');
        $query->leftJoin('rel.page', 'pge');

        if(isset($parameters['widget']) == 1) {
            $query->andWhere('wdg.id = :widget');
            $query->setParameter(':widget', $parameters['widget']);
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('pge.isActive = :active');
            $query->setParameter(':active', true);
        }

        $query->orderBy('rel.ordering');

        $getQuery = $query->getQuery();

        $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
        if(isset($parameters['active']) == 1 && $parameters['active'] == true && isset($parameters['widget']) == 1) {
            $cacheId = 'axipi/relations/'.$parameters['widget']->getId();
            $getQuery->setResultCacheDriver($cacheDriver);
            $getQuery->setResultCacheId($cacheId);
            $getQuery->setResultCacheLifetime(86400);
        }

        return $getQuery->getResult();
    }
}
