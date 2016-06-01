<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LanguageRepository extends EntityRepository {
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

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('lng');
        $query->from('AxipiCoreBundle:Language', 'lng');

        if(isset($parameters['active']) == 1 && $parameters['active'] == true) {
            $query->andWhere('lng.isActive = :active');
            $query->setParameter(':active', 1);
        }

        $query->addOrderBy('lng.title');

        return $query->getQuery()->getResult();
    }
}
