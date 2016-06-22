<?php
namespace Axipi\CoreBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\Relation;
use Axipi\CoreBundle\Event\RelationEvent;

class RelationManager extends AbstractManager
{
    public function getOne($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Relation')->getOne($parameters);
    }

    public function getList($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Relation')->getList($parameters);
    }

    public function persist($data)
    {
        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();

        $event = new RelationEvent($data);
        $this->eventDispatcher->dispatch('relation.after_persist', $event);

        $this->removeCache();

        return $data->getId();
    }

    public function remove($data)
    {
        $event = new RelationEvent($data);
        $this->eventDispatcher->dispatch('relation.before_remove', $event);

        $this->em->remove($data);
        $this->em->flush();

        $this->removeCache();
    }

    public function removeCache()
    {
        if(function_exists('apcu_clear_cache')) {
            apcu_clear_cache();
        }
    }
}
