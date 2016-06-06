<?php
namespace Axipi\MCoreBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Axipi\CoreBundle\Entity\Component;

class ComponentManagerTest extends KernelTestCase
{
    protected $componentManager;

    protected $category;
    protected $service;
    protected $title;
    protected $isActive;

    protected function setUp()
    {
        self::bootKernel();

        $this->componentManager = static::$kernel->getContainer()->get('axipi_core_manager_component');

        $this->category = 'page';
        $this->service = 'test-unit';
        $this->title = 'Test unit';
        $this->isActive = true;
    }

    public function testPersist()
    {
        $data = new Component();
        $data->setCategory($this->category);
        $data->setService($this->service);
        $data->setTitle($this->title);
        $data->setIsActive($this->isActive);

        $this->componentManager->persist($data);

        $test = $this->componentManager->getOne(['service' => $this->service]);

        $this->assertInstanceOf(Component::class, $test);
        $this->assertEquals($this->category, $test->getCategory());
        $this->assertEquals($this->service, $test->getService());
        $this->assertEquals($this->title, $test->getTitle());
        $this->assertEquals($this->isActive, $test->getIsActive());
    }

    public function testRemove()
    {
        $data = $this->componentManager->getOne(['service' => $this->service]);

        $this->componentManager->remove($data);

        $test = $this->componentManager->getOne(['service' => $this->service]);

        $this->assertEquals(null, $test);
    }
}
