<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Axipi\CoreBundle\Entity\User;

class UserRepository extends EntityRepository
{
    public function getOne($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('usr');
        $query->from('AxipiCoreBundle:User', 'usr');

        if(isset($parameters['id']) == 1) {
            $query->andWhere('usr.id = :id');
            $query->setParameter(':id', $parameters['id']);
        }

        if(isset($parameters['username']) == 1) {
            $query->andWhere('usr.username = :username');
            $query->setParameter(':username', $parameters['username']);
        }

        return $query->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('usr');
        $query->from('AxipiCoreBundle:User', 'usr');

        $query->orderBy('usr.username');

        return $query->getQuery()->getResult();
    }
}
