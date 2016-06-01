<?php
namespace Axipi\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RelationRepository extends EntityRepository {
    public function getOne($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('rel', 'wdg', 'pge');
        $query->from('AxipiCoreBundle:Relation', 'rel');
        $query->leftJoin('rel.widget', 'wdg');
        $query->leftJoin('rel.page', 'pge');

        if(isset($parameters['id']) == 1) {
            $query->andWhere('rel.id = :id');
            $query->setParameter(':id', $parameters['id']);
        }

        return $query->getQuery()->getOneOrNullResult();
    }

    public function getList($parameters = []) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder();
        $query->addSelect('rel', 'wdg', 'pge');
        $query->from('AxipiCoreBundle:Relation', 'rel');
        $query->leftJoin('rel.widget', 'wdg');
        $query->leftJoin('rel.page', 'pge');

        if(isset($parameters['widget']) == 1) {
            $query->andWhere('wdg.id = :widget');
            $query->setParameter(':widget', $parameters['widget']);
        }

        $query->orderBy('rel.ordering');

        return $query->getQuery()->getResult();
    }
}
