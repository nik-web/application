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
use Laminas\Db\ResultSet\ResultSet;
use User\Entity\Securitytoken;
use User\ValueObject\Data;
use Laminas\Db\TableGateway\TableGateway;
use User\Repository\LaminasDbTableGatewaySecuritytoken;

/**
 * LaminasDbTableGatewaySecuritytokenFactory
 *
 * @package User\Repository\Factory
 */
class LaminasDbTableGatewaySecuritytokenFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return LaminasDbTableGatewayRole
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get(mysqlAdapter::class);
        $features = null;
        $resultSet = new ResultSet();
        $arrayObjectPrototype = new Securitytoken();
        $resultSet->setArrayObjectPrototype($arrayObjectPrototype);
        $tableGateway = new TableGateway(Data::SECURITYTOKENS_DB_TABLE_NAME, $adapter, $features, $resultSet);
        
        return new LaminasDbTableGatewaySecuritytoken($tableGateway); 
    }
}
