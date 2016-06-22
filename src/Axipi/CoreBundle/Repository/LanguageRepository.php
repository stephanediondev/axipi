<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Language;

class LanguageRepository extends EntityRepository
{
    public function getOne($parameters) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('lng');
        $query->from('AxipiCoreBundle:Language', 'lng');

        if(isset($parameters['id']) == 1) {
            $query->andWhere('lng.id = :id');
            $query->setParameter(':id', $parameters['id']);
        }

        if(isset($parameters['code']) == 1) {
            $query->andWhere('lng.code = :id');
            $query->setParameter(':id', $parameters['code']);
        }

        return $query->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('lng');
        $query->from('AxipiCoreBundle:Language', 'lng');

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('lng.isActive = :active');
            $query->setParameter(':active', true);
        }

        $query->addOrderBy('lng.title');

        $getQuery = $query->getQuery();

        if(isset($parameters['active']) == 1 && $parameters['active'] == true && function_exists('apcu_clear_cache')) {
            $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
            $cacheDriver->setNamespace('axipi_language_');
            $getQuery->setResultCacheDriver($cacheDriver);
            $getQuery->setResultCacheLifetime(86400);
        }
        return $getQuery->getResult();
    }
}
