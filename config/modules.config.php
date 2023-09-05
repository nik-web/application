<?php

/**
 * This file is part of application with Laminas MVC framework
 * 
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 * 
 * If the "laminas/laminas-component-installer" is used by installation of 
 * Laminas components, this file will be added automatically.
 * 
 * @package    base-application
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

return [
    'Laminas\Mvc\Plugin\Identity',
    'Laminas\Db',
    'Laminas\Mvc\Plugin\FlashMessenger',
    'Laminas\Mail',
    'Laminas\Session',
    'Laminas\Mvc\I18n',
    'Laminas\Form',
    'Laminas\I18n',
    'Laminas\InputFilter',
    'Laminas\Filter',
    'Laminas\Hydrator',
    'Laminas\Navigation',
    'Laminas\Router',
    'Laminas\Validator',
    'Application',
    'Contact',
    'User',
];
