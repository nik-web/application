<?php

/**
 * This file is part of application with Laminas MVC framework
 * 
 * This configuration of the application module is passed on to the
 * corresponding components by the ServiceManager.
 *
 * @package    Application  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [   
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'router'      => [
        'routes' => [            
            'home'         => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'imprint'       => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/impressum',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'imprint',
                    ],
                ],
            ],
            'privacy-policy' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/datenschutz',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'privacy-policy',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [        
        'doctype'            => 'HTML5',
        'exception_template' => 'error/index',
        'not_found_template' => 'error/404',
        'template_map'       => [
            'layout/layout'                    => __DIR__ . '/../view/layout/layout.phtml',
            'error/index'                      => __DIR__ . '/../view/error/index.phtml',
            'error/404'                        => __DIR__ . '/../view/error/404.phtml',
            'application/index/index'          => __DIR__ . '/../view/application/index/index.phtml',
            'application/index/imprint'        => __DIR__ . '/../view/application/index/imprint.phtml',
            'application/index/privacy-policy' => __DIR__ . '/../view/application/index/privacy-policy.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers'  => [                                         
        'aliases'   => [
            'provider_name'    => View\Helper\ProviderName::class,
            'provider_address' => View\Helper\ProviderAddress::class,
            'provider_contact' => View\Helper\ProviderContactData::class,
            'copyright_notice' => View\Helper\CopyrightNotice::class,
        ],
        'factories' => [
            View\Helper\ProviderName::class        => InvokableFactory::class,
            View\Helper\ProviderAddress::class     => InvokableFactory::class,
            View\Helper\ProviderContactData::class => InvokableFactory::class,
            View\Helper\CopyrightNotice::class     => InvokableFactory::class,
        ],        
    ],
];
