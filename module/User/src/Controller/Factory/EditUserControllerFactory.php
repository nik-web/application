<?php

/**
 * This file is part of application with Laminas MVC framework
 *
 * @package    User\Controller\Factory  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use User\Repository\UserInterface;
use User\Form\UserEditForm;
use User\Controller\EditUserController;

/**
 * EditUserControllerFactory
 *
 * @package User\Controller\Factory
 */
class EditUserControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return EditUserController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        $repository = $container->get(UserInterface::class);
        $form = $container->get(UserEditForm::class);
        
        return new EditUserController($repository, $form); 
    }
}
