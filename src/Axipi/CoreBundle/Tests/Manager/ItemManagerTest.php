<?php
namespace Axipi\MCoreBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Axipi\CoreBundle\Entity\Item;
use Axipi\CoreBundle\Entity\Language;
use Axipi\CoreBundle\Entity\Component;

class ItemManagerTest extends KernelTestCase
{
    protected $itemManager;

    protected $languageManager;

    protected $componentManager;

    protected $slug;
    protected $title;
    protected $language;
    protected $component;
    protected $isActive;

    protected function setUp()
    {
        self::bootKernel();

        $this->itemManager = static::$kernel->getContainer()->get('axipi_core_manager_item');
        $this->languageManager = static::$kernel->getContainer()->get('axipi_core_manager_language');
        $this->componentManager = static::$kernel->getContainer()->get('axipi_core_manager_component');

        $this->slug = 'test-unit';
        $this->title = 'Test unit';
        $this->language = $this->languageManager->getOne(['code' => 'en']);
        $this->component = $this->componentManager->getOne(['service' => 'axipi_content_controller_page']);
        $this->isActive = true;
    }

    public function testPersist()
    {
        $data = new Item();
        $data->setSlug($this->slug);
        $data->setTitle($this->title);
        $data->setLanguage($this->language);
        $data->setComponent($this->component);
        $data->setIsActive($this->isActive);

        $this->itemManager->persist($data);

        $test = $this->itemManager->getOne(['slug' => $this->slug, 'language_code' => $this->language->getCode()]);

        $this->assertInstanceOf(Item::class, $test);
        $this->assertEquals($this->slug, $test->getSlug());
        $this->assertEquals($this->title, $test->getTitle());
        $this->assertInstanceOf(Language::class, $test->getLanguage());
        $this->assertEquals($this->language, $test->getLanguage());
        $this->assertInstanceOf(Component::class, $test->getComponent());
        $this->assertEquals($this->component, $test->getComponent());
        $this->assertEquals($this->isActive, $test->getIsActive());
    }

    public function testRemove()
    {
        $data = $this->itemManager->getOne(['slug' => $this->slug, 'language_code' => $this->language->getCode()]);
        $this->itemManager->remove($data);

        $test = $this->itemManager->getOne(['slug' => $this->slug, 'language_code' => $this->language->getCode()]);

        $this->assertEquals(null, $test);
    }
}
