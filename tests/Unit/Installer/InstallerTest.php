<?php

namespace Company\Module\Tests\Unit\Installer;

use Mockery\Mock;
use PrestaShopBundle\Install\Install;
use Company\Module\Installer\Installer;

class InstallerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Module
     */
    private $module;

    /**
     * @var \Db|Mock
     */
    private $database;

    public function testShouldBootstrapPrestashop()
    {
        $this->assertTrue(defined('_PS_MODE_DEV_'), 'Prestashop debug mode is defined');
        $this->assertTrue(defined('_DB_PREFIX_'), 'Prestashop database prefix is defined');
    }

    public function testShouldRegisterHook() {
        $installer = new Installer($this->module, $this->database);
        $installer->registerHook('displaySomething');
        $this->assertEquals(1, count($installer->getHookList()));
    }

    public function testShouldRegisterDuringInstall() {
        $this->module->shouldReceive('registerHook')
            ->atLeast()
            ->times(1)
            ->andReturn(true);
        $this->database->shouldReceive('execute')->andReturn(true);

        $installer = new Installer($this->module, $this->database);
        $installer->registerHook('displaySomething');

        $installResult = $installer->install();
        $this->assertTrue($installResult);
    }

    public function testShouldLoadSqlMigrationsFromResourceDirectory() {
        $database = $this->mockDatabase();
        $database
            ->shouldReceive('execute')
            ->atLeast()
            ->times(1)
            ->andReturn(true);

        $installer = new Installer($this->module, $database);
        $installer->setPath(_TEST_DIRECTORY_.'/resources/');

        $installResult = $installer->install();

        $this->assertTrue($installResult);
    }

    public function testShouldPassHooksByArray() {
        $installer = new Installer($this->module, $this->database);
        $installer->registerHooks(['displaySomething', 'displaySomethingElse']);

        $this->assertEquals(2, count($installer->getHookList()));
    }

    public function setUp()
    {
        $this->module = \Mockery::mock('ExampleModule, \Module')->makePartial();
        $this->module->shouldReceive('install')->andReturn('true');
        $this->database = $this->mockDatabase();
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @return \Db|Mock
     */
    private function mockDatabase() {
        $database = \Mockery::mock('DatabaseMock, \Db')->makePartial();
        $pdoMock = \Mockery::mock('\DbPDO')->makePartial();
        $pdoMock->shouldIgnoreMissing();

        return $database;
    }
}
