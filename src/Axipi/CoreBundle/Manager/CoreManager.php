<?php
namespace Axipi\CoreBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;

class CoreManager extends AbstractManager
{
    protected $program;

    protected $page;

    public function setProgram($program)
    {
        $this->program = $program;
    }

    public function getProgram()
    {
        return $this->program;
    }

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
        return $this->em->getRepository('AxipiCoreBundle:Page')->findOneSlug($slug);
    }
}
