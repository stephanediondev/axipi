<?php
namespace Axipi\BackendBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;

class WidgetManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:Widget')->getById($id);
    }

    public function getRows()
    {
        return $this->em->getRepository('AxipiCoreBundle:Widget')->getRows();
    }

    public function getPrograms()
    {
        return $this->em->getRepository('AxipiCoreBundle:Widget')->getPrograms();
    }

    public function getComponents()
    {
        return $this->em->getRepository('AxipiCoreBundle:Widget')->getComponents();
    }

    public function getZones()
    {
        return $this->em->getRepository('AxipiCoreBundle:Widget')->getZones();
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
        return Widget::class;
    }
}
