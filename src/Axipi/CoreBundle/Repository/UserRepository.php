<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {
    public function getById($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('usr');
        $query->from('AxipiCoreBundle:User', 'usr');
        $query->where('usr.id = :id');
        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
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
