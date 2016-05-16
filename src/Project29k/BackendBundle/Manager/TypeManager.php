<?php
namespace Project29k\BackendBundle\Manager;

use Project29k\CoreBundle\Manager\AbstractManager;

class TypeManager extends AbstractManager
{
    public function getCategories()
    {
        return $this->em->getRepository('CoreBundle:Category')->getCategories([]);
    }

    public function persist($data)
    {
        print_r($data);
        if($data->getDatecreated() == null) {
            $data->setDatecreated(new \Datetime());
        }

        $this->em->persist($data);
        $this->em->flush();
    }

    public function getEntityName()
    {
        return Type::class;
    }
}
