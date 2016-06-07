<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\Component;

class ComponentRepository extends EntityRepository
{
    public function getOne($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp');
        $query->from('AxipiCoreBundle:Component', 'cmp');

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

        return $query->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cmp');
        $query->from('AxipiCoreBundle:Component', 'cmp');

        if(isset($parameters['category']) == 1) {
            $query->andWhere('cmp.category = :category');
            $query->setParameter(':category', $parameters['category']);
        }

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('cmp.isActive = :active');
            $query->setParameter(':active', true);
        }

        $query->orderBy('cmp.title');

        return $query->getQuery()->getResult();
    }
}
