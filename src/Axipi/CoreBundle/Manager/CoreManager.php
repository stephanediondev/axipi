<?php

namespace Axipi\CoreBundle\Manager;

class CoreManager
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
}
