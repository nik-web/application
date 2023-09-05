<?php

/**
 * This file is part of application with Laminas MVC framework
 *
 * @package    User\Service  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Service;

use User\Service\AuthManagerInterface;
use Laminas\Authentication\AuthenticationServiceInterface;
use User\Repository\SecuritytokenInterface;
use User\Entity\Securitytoken;
use Laminas\Http\Header\SetCookie;

/**
 * AuthManager class
 * 
 * The main business logic behind authentication is implemented in this service.
 *
 * @package User\Service
 */
class AuthManager implements AuthManagerInterface
{
    /**
    * @var AuthenticationServiceInterface
    */
    protected $authService;
    
    /**
     * @var SecuritytokenInterface
     */
    protected $repository;

    /**
     * Constructs the service.
     * 
     * @param AuthenticationServiceInterface $authService
     * @param SecuritytokenInterface $repository
     */
    public function __construct(
        AuthenticationServiceInterface $authService,
        SecuritytokenInterface $repository
    ) {
        $this->authService = $authService;
        $this->repository = $repository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function login($log, $password, $rememberMe): array
    {
        $data = [];
        // Allow login only if the user is not logged in.
        if (null == $this->authService->getIdentity()) {
            // Authenticate with email/password.
            $authAdapter = $this->authService->getAdapter();
            $authAdapter->setLog($log);
            $authAdapter->setPassword($password);
            // \Laminas\Authentication\Result
            $result = $this->authService->authenticate();
            $resultCode = $result->getCode();
            $data['code'] = $resultCode;
            if (1 === $resultCode) {
                $identity = $this->authService->getIdentity();
                // Delete old token from db
                $securitytoken = $this->repository->findByIdentity($identity);
                if ($securitytoken instanceof Securitytoken) {
                    $this->repository->delete($securitytoken); 
                }
            }
            if ($rememberMe && 1 === $resultCode) {
                // Create new securitytoken
                $securitytoken = new Securitytoken();
                $securitytoken->setIdentity($identity);
                $securitytoken->setIdentifier();
                $randomString = Securitytoken::getRandomString();
                $securitytoken->setToken($randomString);
                $securitytoken->setCreatedOn();
                // Insert securitytoken to db
                $this->repository->insert($securitytoken);
                $cookieIdentifier = new SetCookie(
                    'identifier', $securitytoken->getIdentifier(),
                    time()+(3600*24*365), '/'
                );
                $data['identifier'] = $cookieIdentifier;
                $cookieToken = new SetCookie(
                    'securitytoken', $randomString, time()+(3600*24*365), '/'
                );
                $data['securitytoken'] = $cookieToken;
            }
        }
        
        return $data;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function logout(): void
    {
        $identity = $this->authService->getIdentity();
        // Allow to log out only when user is logged in.
        if ($identity != null) {
            $securitytoken = $this->repository->findByIdentity($identity);
            if ($securitytoken instanceof Securitytoken) {
                $this->repository->delete($securitytoken); 
            }           
            $this->authService->clearIdentity();
        }
    }
}
