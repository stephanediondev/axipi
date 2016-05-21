<?php
namespace Axipi\BackendBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\Page;

class PageManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getById($id);
    }

    public function getRows()
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getRows();
    }

    public function getPrograms()
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getPrograms();
    }

    public function getComponents()
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getComponents();
    }

    public function getPages(Page $page)
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getPages($page);
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
        return Page::class;
    }
}
