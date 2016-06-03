<?php
namespace Axipi\CoreBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;

class ComponentManager extends AbstractManager
{
    public function getOne($paremeters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Component')->getOne($paremeters);
    }

    public function getList($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Component')->getList($parameters);
    }

    public function persist($data)
    {
        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();
        return $data->getId();
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}
