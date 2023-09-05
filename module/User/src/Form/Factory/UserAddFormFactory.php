<?php

/**
 * This file is part of application with Laminas MVC framework
 *
 * @package    User\Form  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace User\Form\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use mysqlAdapter;
use User\Form\UserAddForm;

/**
 * UserAddFormFactory
 *
 * @package User\Form
 */
class UserAddFormFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * 
     * @return UserAddForm
     */
    public function __invoke(ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        // Container gif Instanz of Laminas\Db\Adapter\Adapter
        $dbAdapter = $container->get(mysqlAdapter::class);
        $form = new UserAddForm($dbAdapter);
        
        return $form; 
    }
}
