<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Language;
use Symfony\Component\EventDispatcher\Event;

class LanguageEvent extends Event
{
    protected $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }
}
