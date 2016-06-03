<?php
namespace Axipi\CoreBundle\Manager;

use Axipi\CoreBundle\Manager\AbstractManager;

class DefaultManager extends AbstractManager
{
    protected $page;

    protected $languages;

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    public function getLanguages()
    {
        return $this->languages;
    }
}
