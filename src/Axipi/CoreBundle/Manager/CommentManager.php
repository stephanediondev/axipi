<?php
namespace Axipi\CoreBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\Comment;
use Axipi\CoreBundle\Event\CommentEvent;

class CommentManager extends AbstractManager
{
    public function getOne($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Comment')->getOne($parameters);
    }

    public function getList($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Comment')->getList($parameters);
    }

    public function persist($data)
    {
        if($data->getDateCreated() == null) {
            $mode = 'insert';
            $data->setDateCreated(new \Datetime());
        } else {
            $mode = 'update';
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();

        $event = new CommentEvent($data, $mode);
        $this->eventDispatcher->dispatch('comment.after_persist', $event);

        $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
        $cacheId = 'axipi_comment_'.$data->getItem()->getId();
        if($cacheDriver->contains($cacheId)) {
            $cacheDriver->delete($cacheId);
        }

        return $data->getId();
    }

    public function remove($data)
    {
        $event = new CommentEvent($data, 'delete');
        $this->eventDispatcher->dispatch('comment.before_remove', $event);

        $this->em->remove($data);
        $this->em->flush();

        $cacheDriver = new \Doctrine\Common\Cache\ApcuCache();
        $cacheId = 'axipi_comment_'.$data->getItem()->getId();
        if($cacheDriver->contains($cacheId)) {
            $cacheDriver->delete($cacheId);
        }
    }
}
