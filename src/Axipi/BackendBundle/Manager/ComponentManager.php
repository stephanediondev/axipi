<?php
namespace Axipi\BackendBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Repository\Component;

class ComponentManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:Component')->findOne($id);
    }

    public function getIndex()
    {
        return $this->em->getRepository('AxipiCoreBundle:Component')->getIndex();
    }

    public function getCategories()
    {
        return $this->em->getRepository('AxipiCoreBundle:Category')->getCategories();
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
        return Type::class;
    }
}
