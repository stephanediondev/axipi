<?php
namespace Axipi\CoreBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;

class CoreManager extends AbstractManager
{
    protected $page;

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getBySlug($slug)
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getBySlug($slug);
    }
}
