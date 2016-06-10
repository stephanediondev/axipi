<?php
namespace Axipi\CoreBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\Language;
use Axipi\CoreBundle\Event\LanguageEvent;

class LanguageManager extends AbstractManager
{
    public function getOne($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Language')->getOne($parameters);
    }

    public function getList($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Language')->getList($parameters);
    }

    public function persist($data)
    {
        $this->removeCache($data);

        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();

        $event = new LanguageEvent($data);
        $this->eventDispatcher->dispatch('language.after_persist', $event);

        return $data->getId();
    }

    public function remove($data)
    {
        $this->removeCache($data);

        $event = new LanguageEvent($data);
        $this->eventDispatcher->dispatch('language.before_remove', $event);

        $this->em->remove($data);
        $this->em->flush();
    }

    public function removeCache($data)
    {
        $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();

        $cacheId = 'axipi/languages';
        if($cacheDriver->contains($cacheId)) {
            $cacheDriver->delete($cacheId);
        }
    }
}
