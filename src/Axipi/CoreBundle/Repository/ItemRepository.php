<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Item;

class ItemRepository extends EntityRepository
{
    public function getOne($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('itm', 'cmp', 'lng', 'itm_parent');
        $query->from('AxipiCoreBundle:Item', 'itm');
        $query->leftJoin('itm.component', 'cmp');
        $query->leftJoin('itm.language', 'lng');
        $query->leftJoin('itm.parent', 'itm_parent');

        if(isset($parameters['id']) == 1) {
            $query->andWhere('itm.id = :id');
            $query->setParameter(':id', $parameters['id']);
        }

        if(isset($parameters['previous_id']) == 1) {
            $query->andWhere('itm.id < :id');
            $query->setParameter(':id', $parameters['previous_id']);
        }

        if(isset($parameters['next_id']) == 1) {
            $query->andWhere('itm.id > :id');
            $query->setParameter(':id', $parameters['next_id']);
        }

        if(isset($parameters['slug']) == 1) {
            if($parameters['slug'] == '') {
                $query->andWhere('itm.slug IS NULL');
            } else {
                $query->andWhere('itm.slug = :slug');
                $query->setParameter(':slug', $parameters['slug']);
            }

            $query->andWhere('cmp.category = :category');
            $query->setParameter(':category', 'page');
        }

        if(isset($parameters['language_code']) == 1) {
            $query->andWhere('lng.code = :language');
            $query->setParameter(':language', $parameters['language_code']);
        }

        if(isset($parameters['component_service']) == 1) {
            $query->andWhere('cmp.service = :component_service');
            $query->setParameter(':component_service', $parameters['component_service']);
        }

        if(isset($parameters['parent']) == 1) {
            $query->andWhere('itm.parent = :parent');
            $query->setParameter(':parent', $parameters['parent']);
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('itm.isActive = :active');
            $query->setParameter(':active', true);
        }

        $getQuery = $query->getQuery();
        $getQuery->setMaxResults(1);

        if(isset($parameters['active']) == 1 && $parameters['active'] == true && function_exists('apcu_clear_cache')) {
            $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
            $cacheDriver->setNamespace('axipi_item_');
            $getQuery->setResultCacheDriver($cacheDriver);
            $getQuery->setResultCacheLifetime(86400);
        }
        return $getQuery->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('itm', 'cmp', 'lng', 'itm_parent');
        $query->from('AxipiCoreBundle:Item', 'itm');
        $query->leftJoin('itm.component', 'cmp');
        $query->leftJoin('itm.language', 'lng');
        $query->leftJoin('itm.zone', 'zon');
        $query->leftJoin('itm.parent', 'itm_parent');

        if(isset($parameters['ids']) == 1) {
            $query->where('itm.id IN ('.implode(',', $parameters['ids']).')');
        }

        if(isset($parameters['exclude_search']) == 1 && $parameters['exclude_search'] == true) {
            $query->andWhere('itm.excludeSearch = :exclude_search');
            $query->andWhere('cmp.excludeSearch = :exclude_search');
            $query->setParameter(':exclude_search', false);
        }

        if(isset($parameters['exclude_sitemap']) == 1 && $parameters['exclude_sitemap'] == true) {
            $query->andWhere('itm.excludeSitemap = :exclude_sitemap');
            $query->andWhere('cmp.excludeSitemap = :exclude_sitemap');
            $query->setParameter(':exclude_sitemap', false);
        }

        if(isset($parameters['is_home']) == 1 && $parameters['is_home'] == true) {
            $query->andWhere('itm.isHome = :is_home');
            $query->setParameter(':is_home', true);
        }

        if(isset($parameters['category']) == 1) {
            $query->andWhere('cmp.category = :category');
            $query->setParameter(':category', $parameters['category']);
        }

        if(isset($parameters['language_code']) == 1) {
            $query->andWhere('lng.code = :language');
            $query->setParameter(':language', $parameters['language_code']);
        }

        if(isset($parameters['language_code_or_language_null']) == 1) {
            $query->andWhere('(lng.code = :language OR itm.language IS NULL)');
            $query->setParameter(':language', $parameters['language_code_or_language_null']);
        }

        if(isset($parameters['zone_code']) == 1) {
            $query->andWhere('zon.code = :zone');
            $query->setParameter(':zone', $parameters['zone_code']);
        }

        if(isset($parameters['zone_null']) == 1 && $parameters['zone_null'] == true) {
            $query->andWhere('itm.zone IS NULL');
        }

        if(isset($parameters['parent']) == 1) {
            $query->andWhere('itm.parent = :parent');
            $query->setParameter(':parent', $parameters['parent']);
        }

        if(isset($parameters['parent_null']) == 1 && $parameters['parent_null'] == true) {
            $query->andWhere('itm.parent IS NULL');
        }

        if(isset($parameters['parent_not_null']) == 1 && $parameters['parent_not_null'] == true) {
            $query->andWhere('itm.parent IS NOT NULL');
        }

        if(isset($parameters['component_service']) == 1) {
            $query->andWhere('cmp.service = :component_service');
            $query->setParameter(':component_service', $parameters['component_service']);
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('itm.isActive = :active');
            $query->setParameter(':active', true);
        }

        if(isset($parameters['component_parent']) == 1) {
            if($parameters['component_parent']->getComponent()->getParent()) {
                $query->andWhere('itm.component = :component_parent');
                $query->setParameter(':component_parent', $parameters['component_parent']->getComponent()->getParent());
            }
        }

        if(isset($parameters['category']) == 1) {
            if($parameters['category'] == 'page') {
                $query->addOrderBy('itm.slug');
            }
            if($parameters['category'] == 'widget') {
                $query->addOrderBy('itm.ordering');
            }
        }

        $query->addOrderBy('itm.ordering');
        $query->addOrderBy('itm.title');

        $getQuery = $query->getQuery();

        if(isset($parameters['active']) == 1 && $parameters['active'] == true && function_exists('apcu_clear_cache')) {
            $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
            $cacheDriver->setNamespace('axipi_item_');
            $getQuery->setResultCacheDriver($cacheDriver);
            $getQuery->setResultCacheLifetime(86400);
        }
        return $getQuery->getResult();
    }

    public function testSlug($data) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('itm', 'cmp');
        $query->from('AxipiCoreBundle:Item', 'itm');
        $query->leftJoin('itm.component', 'cmp');

        $query->andWhere('itm.slug = :slug');
        $query->setParameter(':slug', $data->getSlug());

        $query->andWhere('itm.language = :language');
        $query->setParameter(':language', $data->getLanguage());

        if($data->getId()) {
            $query->andWhere('itm.id != :id');
            $query->setParameter(':id', $data->getId());
        }

        return $query->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }

    public function testCode($data) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('itm', 'cmp');
        $query->from('AxipiCoreBundle:Item', 'itm');
        $query->leftJoin('itm.component', 'cmp');

        $query->andWhere('itm.code = :code');
        $query->setParameter(':code', $data->getCode());

        $query->andWhere('itm.language = :language');
        $query->setParameter(':language', $data->getLanguage());

        if($data->getId()) {
            $query->andWhere('itm.id != :id');
            $query->setParameter(':id', $data->getId());
        }

        return $query->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }
}
