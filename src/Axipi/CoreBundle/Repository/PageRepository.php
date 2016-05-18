<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class PageRepository extends EntityRepository {
    public function findOne($id) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('typ');//, 'cat'
        $query->from('AxipiCoreBundle:Page', 'typ');
        $query->where('typ.id = :id');
        $query->setParameter(':id', $id);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function findOneSlug($slug) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('typ');//, 'cat'
        $query->from('AxipiCoreBundle:Page', 'typ');
        $query->where('typ.slug = :slug');
        $query->setParameter(':slug', $slug);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getIndex() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('typ');
        $query->from('AxipiCoreBundle:Page', 'typ');

        return $query->getQuery();
    }

    public function getPrograms() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('prg', 'lng', 'cou');
        $query->from('AxipiCoreBundle:Program', 'prg');
        $query->leftJoin('prg.language', 'lng');
        $query->leftJoin('prg.country', 'cou');

        return $query->getQuery()->getResult();
    }

    public function getComponents() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('cat');
        $query->from('AxipiCoreBundle:Component', 'cat');

        return $query->getQuery()->getResult();
    }
}
