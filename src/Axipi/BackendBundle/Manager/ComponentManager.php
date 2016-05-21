<?php
namespace Axipi\BackendBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;

class ComponentManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:Component')->getById($id);
    }

    public function getRows()
    {
        return $this->em->getRepository('AxipiCoreBundle:Component')->getRows();
    }

    public function getCategories()
    {
        return ['page', 'widget'];
    }

    public function getZones()
    {
        return $this->em->getRepository('AxipiCoreBundle:Component')->getZones();
    }

    public function persist($data)
    {
        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($type)
    {
        $this->em->remove($type);
        $this->em->flush();
    }

    public function getEntityName()
    {
        return Type::class;
    }
}
