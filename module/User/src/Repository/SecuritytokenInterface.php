<?php

/**
 * This file is part of application Laminas MVC framework
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

use User\Entity\Securitytoken;

/**
 * Describes the interface of the securitytoken repository
 * 
 * @package User\Repository
 */
interface SecuritytokenInterface
{
    /**
     * Return a single securitytoken.
     * 
     * @param string $identity user auth identity
     * @return Securitytoken|null
     */
    public function findByIdentity($identity): ?Securitytoken;
    
    /**
     * Return a single securitytoken.
     * 
     * @param string $identifier
     * @return Securitytoken|null
     */
    public function findByIdentifier($identifier): ?Securitytoken;    
    /**
     * Persist a new securitytoken in the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to insert; may or may not have an identifier.
     * @return null|int $id
     */
    public function insert(Securitytoken $securitytoken): ?int;
    
    /**
     * Update an existing securitytoken in the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to update; must have an identifier.
     * @return null|Securitytoken
     */
    public function update(Securitytoken $securitytoken): bool;
    
    /**
     * Delete a securitytoken from the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to delete.
     * @return boolean
     */
    public function delete(Securitytoken $securitytoken): bool;
    
}
