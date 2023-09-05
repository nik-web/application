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

use User\Entity\User;

/**
 * Describes the interface of the user repository
 * 
 * @package User\Repository
 */
interface UserInterface
{
    /**
     * Return a set of all user users that we can iterate over.
     *
     * Each entry should be a user instance.
     *
     * @return \Laminas\Db\ResultSet\HydratingResultSet | array
     */
    public function findAllUsers();
    
    /**
     * Return a paginator instance
     *
     * Each entry should be a user instance.
     *
     * @return \Laminas\Paginator\Paginator
     */
    //public function findAllUsersPaginated();
    
    /**
     * Return a single user or null.
     *
     * @param  int $userId Identifier of the user to return.
     * @return User | null
     */
    public function findUserById($userId): ?User;
    
    /**
     * Return a single user or void.
     *
     * @param  sring $email email address of the user to return.
     * @return User | void
     */
    public function findByEmail($email): ?User;
    
    /**
     * Return a single user or void.
     *
     * @param  sring $alias alias of the user to return.
     * @return User | void
     */
    public function findByAlias($alias): ?User;
    
    /**
     * Persist a new user in the system.
     *
     * @param User $user The user to insert; may or may not have an identifier.
     * @return int $id new user identifier
     */
    public function insert(User $user): ?int;

    /**
     * Update an existing user in the system.
     *
     * @param User $user The user to update; must have an identifier.
     * @return bool
     */
    public function update(User $user): bool;
    
    /**
     * Delete a user from the system.
     *
     * @param User $user The user to delete.
     * @return bool
     */
    public function delete(User $user): bool;
    
}