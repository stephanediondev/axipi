<?php
namespace Axipi\MCoreBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Axipi\CoreBundle\Entity\Language;

class LanguageManagerTest extends KernelTestCase
{
    protected $languageManager;

    protected $code;
    protected $title;
    protected $isActive;

    protected function setUp()
    {
        self::bootKernel();

        $this->languageManager = static::$kernel->getContainer()->get('axipi_core_manager_language');

        $this->code = 'xx';
        $this->title = 'Test unit';
        $this->isActive = true;
    }

    public function testPersist()
    {
        $data = new Language();
        $data->setCode($this->code);
        $data->setTitle($this->title);
        $data->setIsActive($this->isActive);

        $this->languageManager->persist($data);

        $test = $this->languageManager->getOne(['code' => $this->code]);

        $this->assertInstanceOf(Language::class, $test);
        $this->assertEquals($this->code, $test->getCode());
        $this->assertEquals($this->title, $test->getTitle());
        $this->assertEquals($this->isActive, $test->getIsActive());
    }

    public function testRemove()
    {
        $data = $this->languageManager->getOne(['code' => $this->code]);

        $this->languageManager->remove($data);

        $test = $this->languageManager->getOne(['code' => $this->code]);

        $this->assertEquals(null, $test);
    }
}
