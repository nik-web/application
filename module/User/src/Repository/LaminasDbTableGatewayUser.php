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
use Laminas\Db\Sql\Select;
use User\Entity\User;

/**
 * LaminasDbTableGatewayUser
 *
 * @package User\Repository
 */
class LaminasDbTableGatewayUser implements UserInterface
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
    public function findAllUsers()
    {
        // Laminas\Db\ResultSet\ResultSet
        $rowset = $this->tableGateway->select(function (Select $select) {
            $select->order('id DESC');
        });
        
        return $rowset;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findUserById($userId): ?User
    {
        $rowset = $this->tableGateway->select(['id' => $userId,]);
        $userRow = $rowset->current();
        
        return $userRow;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByEmail($email): ?User
    {
        $rowset = $this->tableGateway->select(['email' => $email,]);
        $userRow = $rowset->current();
        
        return $userRow;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByAlias($alias): ?User
    {
        $rowset = $this->tableGateway->select(['alias' => $alias,]);
        $userRow = $rowset->current();
        
        return $userRow;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function insert(User $user): ?int
    {
        $data = $user->getArrayCopy();
        $affectedRows = $this->tableGateway->insert($data);
        if (1 != $affectedRows) {
            
            return null;
        }
        // Get int last insert id
        $userId = intval($this->tableGateway->getLastInsertValue());
        
        return $userId;
    }
    
    /**
     * {@inheritDoc}
     */
    public function update(User $user): bool
    {
        $data = $user->getArrayCopy();
        $id = (int) $user->getId();
        $affectedRows = $this->tableGateway->update($data,  ['id' => $id,]);
        if (1 === $affectedRows) {
            
            return true;
        }
        
        return false;
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(User $user): bool
    {
        $id = (int) $user->getId();
        $affectedRows = $this->tableGateway->delete(['id' => $id,]);
        if (1 === $affectedRows) {
            
            return true;
        }
        
        return false;
    }
}
