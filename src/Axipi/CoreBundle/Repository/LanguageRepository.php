<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LanguageRepository extends EntityRepository {
    public function getById($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('lng');
        $query->from('AxipiCoreBundle:Language', 'lng');
        $query->where('lng.id = :id');
        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getRows() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('lng');
        $query->from('AxipiCoreBundle:Language', 'lng');

        $query->addOrderBy('lng.title');

        return $query->getQuery()->getResult();
    }
}
