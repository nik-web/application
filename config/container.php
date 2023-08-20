<?php

/**
 * This file is part of application with Laminas MVC framework
 * 
 * @package    application
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

use Laminas\Mvc\Application;
use Laminas\Stdlib\ArrayUtils;

// Retrieve configuration
$appConfig = require __DIR__ . '/application.config.php';
if (file_exists(__DIR__ . '/development.config.php')) {
    $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/development.config.php');
}

return Application::init($appConfig)->getServiceManager();
    