<?php
namespace Axipi\CoreBundle\Repository;

use Axipi\CoreBundle\Repository\AbstractRepository;
use Axipi\CoreBundle\Entity\Component;

class ComponentRepository extends AbstractRepository
{
    public function getOne($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp', 'cmp_parent');
        $query->from('AxipiCoreBundle:Component', 'cmp');
        $query->leftJoin('cmp.parent', 'cmp_parent');

        if(isset($parameters['id']) == 1) {
            $query->andWhere('cmp.id = :id');
            $query->setParameter(':id', $parameters['id']);
        }

        if(isset($parameters['service']) == 1) {
            $query->andWhere('cmp.service = :service');
            $query->setParameter(':service', $parameters['service']);
        }

        if(isset($parameters['is_home']) == 1 && $parameters['is_home'] == true) {
            $query->andWhere('cmp.isHome = :is_home');
            $query->setParameter(':is_home', true);
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('cmp.isActive = :active');
            $query->setParameter(':active', true);
        }

        $getQuery = $query->getQuery();
        $getQuery->setMaxResults(1);

        if(isset($parameters['active']) == 1 && $parameters['active'] == true && $this->cacheAvailable()) {
            $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
            $cacheDriver->setNamespace('axipi_component_');
            $getQuery->setResultCacheDriver($cacheDriver);
            $getQuery->setResultCacheLifetime(86400);
        }
        return $getQuery->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp', 'cmp_parent');
        $query->from('AxipiCoreBundle:Component', 'cmp');
        $query->leftJoin('cmp.parent', 'cmp_parent');

        if(isset($parameters['category']) == 1) {
            $query->andWhere('cmp.category = :category');
            $query->setParameter(':category', $parameters['category']);
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('cmp.isActive = :active');
            $query->setParameter(':active', true);
        }

        $query->addOrderBy('cmp.title');

        $getQuery = $query->getQuery();

        if(isset($parameters['active']) == 1 && $parameters['active'] == true && $this->cacheAvailable()) {
            $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
            $cacheDriver->setNamespace('axipi_component_');
            $getQuery->setResultCacheDriver($cacheDriver);
            $getQuery->setResultCacheLifetime(86400);
        }
        return $getQuery->getResult();
    }
}
