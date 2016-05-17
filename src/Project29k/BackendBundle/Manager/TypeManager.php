<?php
namespace Project29k\BackendBundle\Manager;

use Project29k\CoreBundle\Manager\AbstractManager;

class TypeManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('CoreBundle:Type')->findOne($id);
    }

    public function getIndex()
    {
        return $this->em->getRepository('CoreBundle:Type')->getIndex();
    }

    public function getCategories()
    {
        return $this->em->getRepository('CoreBundle:Category')->getCategories();
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
