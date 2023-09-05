<?php

/**
 * This file is part of application with Laminas MVC framework
 *
 * @package    User\Repository
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Repository\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use mysqlAdapter;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use User\Entity\User;
use User\ValueObject\Data;
use User\Repository\LaminasDbTableGatewayUser;

/**
 * LaminasDbTableGatewayUserFactory
 *
 * @package User\Repository\Factory
 */
class LaminasDbTableGatewayUserFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return LaminasDbTableGatewayReadUser
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $mysqlAdapter = $container->get(mysqlAdapter::class);        
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new User());
        $usersTableGateway = new TableGateway(Data::USERS_DB_TABLE_NAME, $mysqlAdapter, null, $resultSet);
        
        return new LaminasDbTableGatewayUser($usersTableGateway); 
    }
}
