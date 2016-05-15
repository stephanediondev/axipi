<?php

namespace Project29k\CoreBundle\Manager;

class CoreManager
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

}
