<?php

/**
 * This file is part of application with Laminas MVC framework
 *
 * @package    User\Controller\Factory  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/applicattion
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use User\Repository\UserInterface;
use User\Controller\DisplayUsersController;

/**
 * DisplayUsersControllerFactory class
 *
 * @package User\Controller\Factory
 */
class DisplayUsersControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return LaminasDbSqlUser
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DisplayUsersController($container->get(UserInterface::class));
    }
}
