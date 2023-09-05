<?php

/**
 * This file is part of application with Laminas MVC framework
 *
 * @package    User\Controller  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Crypt\Password\Bcrypt;
use User\Repository\UserInterface;
use User\Form\UserAddForm;
use User\Entity\User;

/**
 * AddUserController
 *
 * @package User\Controller
 */
class AddUserController extends AbstractActionController
{    
    /**
     * @var UserAddForm
     */
    private  $form;
    
    /**
     * @var UserInterface
     */
    private $userRepository;
    
    /**
     * Constructs this controller.
     * 
     * @param UserAddForm $form
     * @param UserInterface $userRepository
     */
    public function __construct(UserAddForm $form, UserInterface $userRepository)
    {
        $this->form = $form;
        $this->userRepository = $userRepository;
    }
    
    /**
     * This action will display the add user form.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        // Retrieve the current request.
        $request = $this->getRequest();
        $form = $this->form;        
        // Create a default view model containing the form.
        $viewModel = new ViewModel(['form' => $form]);        
        // If we do not have a POST request, we return the default view model.
        if (! $request->isPost()) {
            
            return $viewModel;
        }
        // Populate the form with data from the request.
        $form->setData($request->getPost());
        // If the form is not valid, we return the default view model; at this point,
        // the form will also contain error messages.
        if (! $form->isValid()) {
            
            return $viewModel;
        }
        // Get only filtered and validated data
        $data = $form->getData();
        $bcrypt = new Bcrypt();
        $data['password'] = $bcrypt->create($data['password']);
        $data['status'] = 1;
        $data['created_on'] = date('Y-m-d H:i:s');
        $user = new User();
        $user->exchangeArray($data);
        if ($this->userRepositoryd->insert($user)) {
            $message = 'Sie haben ein neues Benutzerkonto angelegt.';
            $this->flashmessenger()->addSuccessMessage($message);
        } else {
            $message = 'Es ist ein Fehler beim anlegen des Benutzerkontos aufgetreten!';
            $this->flashmessenger()->addWarningMessage($message);
        }
        
        return $this->redirect()->toRoute('all-users', []);
    }
}
