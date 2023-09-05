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

namespace User\Repository;

use Laminas\Db\TableGateway\TableGateway;
use User\Entity\Securitytoken;

/**
 * Securitytoken
 *
 * @package User\Repository
 */
class LaminasDbTableGatewaySecuritytoken implements SecuritytokenInterface
{
    /**
     * @var TableGateway
     */
    private $tableGateway;

    /**
     * Construct an repository
     * 
     * @param $tableGateway TableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByIdentity($identity): ?Securitytoken
    {
        $rowset = $this->tableGateway->select(['identity' => $identity]);
        $securitytoken = $rowset->current();
        if (! $securitytoken instanceof Securitytoken) {
            
            return null;
        }
        
        return $securitytoken;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByIdentifier($identifier): ?Securitytoken
    {
        $rowset = $this->tableGateway->select(['identifier' => $identifier]);
        $securitytoken = $rowset->current();
        if (! $securitytoken instanceof Securitytoken) {
            
            return null;
        }
        
        return $securitytoken;
    }

    /**
     * {@inheritDoc}
     */
    public function insert(Securitytoken $securitytoken): ?int
    {
        $data = $securitytoken->getArrayCopy();
        $affectedRows = $this->tableGateway->insert($data);   
        if (1 != $affectedRows) {
            
            return null;
        }
        // Get int last insert id
        $securitytokenId = intval($this->tableGateway->getLastInsertValue());
        
        return $securitytokenId;
    }
    
    /**
     * {@inheritDoc}
     */
    public function update(Securitytoken $securitytoken): bool
    {
        $data = $securitytoken->getArrayCopy();
        $id = (int) $securitytoken->getId();
        $affectedRows = $this->tableGateway->update($data,  ['id' => $id,]);
        if (1 === $affectedRows) {
            
            return true;
        }
        
        return false;
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(Securitytoken $securitytoken): bool
    {
        $id = (int) $securitytoken->getId();
        $affectedRows = $this->tableGateway->delete(['id' => $id,]);
        if (1 === $affectedRows) {
            
            return true;
        }
        
        return false;
    }
}
