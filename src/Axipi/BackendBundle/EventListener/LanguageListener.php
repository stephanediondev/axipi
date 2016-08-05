<?php
namespace Axipi\BackendBundle\EventListener;

use Axipi\CoreBundle\Manager\ItemManager;
use Axipi\CoreBundle\Manager\ComponentManager;
use Axipi\CoreBundle\Event\LanguageEvent;
use Axipi\CoreBundle\Entity\Item;

class LanguageListener
{
    protected $itemManager;

    protected $componentManager;

    public function __construct(
        ItemManager $itemManager,
        ComponentManager $componentManager
    ) {
        $this->itemManager = $itemManager;
        $this->componentManager = $componentManager;
    }

    public function persist(LanguageEvent $languageEvent)
    {
        $language = $languageEvent->getData();
        $mode = $languageEvent->getMode();

        if( $mode == 'insert') {
            $component = $this->componentManager->getOne(['is_home' => true, 'active' => true]);

            $page = new Item();
            $page->setLanguage($language);
            $page->setComponent($component);
            $page->setTitle('Home');
            $page->setIsHome($component->getIshome());
            $page->setIsActive(true);

            $this->itemManager->persist($page);
        }
    }
}
