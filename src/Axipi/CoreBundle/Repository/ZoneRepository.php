<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Zone;

class ZoneRepository extends EntityRepository
{
    public function getOne($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('zon');
        $query->from('AxipiCoreBundle:Zone', 'zon');

        if(isset($parameters['id']) == 1) {
            $query->andWhere('zon.id = :id');
            $query->setParameter(':id', $parameters['id']);
        }

        if(isset($parameters['code']) == 1) {
            $query->andWhere('zon.code = :code');
            $query->setParameter(':code', $parameters['code']);
        }

        return $query->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('zon');
        $query->from('AxipiCoreBundle:Zone', 'zon');

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('zon.isActive = :active');
            $query->setParameter(':active', true);
        }

        $query->addOrderBy('zon.ordering');
        $query->addOrderBy('zon.code');

        return $query->getQuery()->getResult();
    }
}
