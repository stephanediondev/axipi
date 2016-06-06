<?php
namespace Axipi\MCoreBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Axipi\CoreBundle\Entity\Zone;

class ZoneManagerTest extends KernelTestCase
{
    protected $zoneManager;

    protected $code;
    protected $isActive;

    protected function setUp()
    {
        self::bootKernel();

        $this->zoneManager = static::$kernel->getContainer()->get('axipi_core_manager_zone');

        $this->code = 'test-unit';
        $this->isActive = true;
    }

    public function testPersist()
    {
        $data = new Zone();
        $data->setCode($this->code);
        $data->setIsActive($this->isActive);

        $this->zoneManager->persist($data);

        $test = $this->zoneManager->getOne(['code' => $this->code]);

        $this->assertInstanceOf(Zone::class, $test);
        $this->assertEquals($this->code, $test->getCode());
        $this->assertEquals($this->isActive, $test->getIsActive());
    }

    public function testRemove()
    {
        $data = $this->zoneManager->getOne(['code' => $this->code]);

        $this->zoneManager->remove($data);

        $test = $this->zoneManager->getOne(['code' => $this->code]);

        $this->assertEquals(null, $test);
    }
}
