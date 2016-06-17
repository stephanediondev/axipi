<?php
namespace Axipi\MCoreBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Axipi\CoreBundle\Entity\User;

class UserManagerTest extends KernelTestCase
{
    protected $zoneManager;

    protected $code;
    protected $isActive;

    protected function setUp()
    {
        self::bootKernel();

        $this->userManager = static::$kernel->getContainer()->get('axipi_core_manager_user');

        $this->username = 'test-unit';
        $this->password = 'test-unit';
        $this->firstname = 'Test unit';
        $this->isActive = true;
    }

    public function testPersist()
    {
        $data = new User();
        $data->setUsername($this->username);
        $data->setPasswordChange($this->password);
        $data->setFirstname($this->firstname);
        $data->setIsActive($this->isActive);

        $this->userManager->persist($data);

        $test = $this->userManager->getOne(['username' => $this->username]);

        $this->assertInstanceOf(User::class, $test);
        $this->assertEquals($this->username, $test->getUsername());
        $this->assertEquals($this->firstname, $test->getFirstname());
        $this->assertEquals($this->isActive, $test->getIsActive());
    }

    public function testRemove()
    {
        $data = $this->userManager->getOne(['username' => $this->username]);

        $this->userManager->remove($data);

        $test = $this->userManager->getOne(['username' => $this->username]);

        $this->assertEquals(null, $test);
    }
}
