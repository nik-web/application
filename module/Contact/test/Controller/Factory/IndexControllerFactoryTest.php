<?php

/**
 * This file is part of application with Laminas MVC framework
 * 
 * Contact module with Laninas MVC framework
 *
 * @package     ContactTest\Controller\Factory
 * @author      Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version     1.0.0
 * @since       1.0.0
 */

declare(strict_types=1);

namespace ContactTest\Controller\Factory;

use PHPUnit\Framework\TestCase;
use Contact\Controller\Factory\IndexControllerFactory;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Mvc\Application;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Contact\Controller\IndexController;

/**
 * IndexControllerFactoryTest class
 *
 * @package ContactTest\Controller\Factory
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class IndexControllerFactoryTest extends TestCase {
    
    /**
     * @var IndexControllerFactory
     */
    public $factory;
    
    /**
     * 
     * @var \Laminas\ServiceManager\ServiceManager
     */
    public $container;

    /**
     * {@inheritDoc}
     *  
     * @return void
     */
    protected function setUp() : void
    {
        $this->factory = new IndexControllerFactory();
        $configOverrides = [];
        // Retrieve configuration
        $appConfig = require __DIR__ . '/../../../../../config/application.config.php';
        if (file_exists(__DIR__ . '/../../../../../config/development.config.php')) {
            $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../../../../../config/development.config.php');
        }
        $config = ArrayUtils::merge($appConfig, $configOverrides);
        $this->container = Application::init($config)->getServiceManager();
    }
    
    /**
     * Test is the index controller factory a instance of 
     * 
     * @return void
     */
    public function testIndexControllerFactoryInstanceOf() : void
    {
        $this->assertInstanceOf(FactoryInterface::class, $this->factory);
    }
    
    /**
     * Test is the index controller factory returns a instance of index controller 
     * 
     * @return void
     */
    public function testInvokeReturnsInstanceOf() {
        $factory = $this->factory;
        // Factory invoke returns this result
        $result = $factory($this->container, null);
        $this->assertInstanceOf(IndexController::class, $result);
    }
}
