<?php
namespace Axipi\BackendBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;

class WidgetPageManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:WidgetPage')->getById($id);
    }

    public function getPages()
    {
        return $this->em->getRepository('AxipiCoreBundle:WidgetPage')->getPages();
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
        return WidgetPage::class;
    }
}
