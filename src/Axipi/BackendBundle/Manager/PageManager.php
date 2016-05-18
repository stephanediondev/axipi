<?php
namespace Axipi\BackendBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Repository\Page;

class PageManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->findOne($id);
    }

    public function getIndex()
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getIndex();
    }

    public function getPrograms()
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getPrograms();
    }

    public function getComponents()
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getComponents();
    }

    public function persist($data)
    {
        if($data->getDatecreated() == null) {
            $data->setDatecreated(new \Datetime());
        }

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
        return Page::class;
    }
}
