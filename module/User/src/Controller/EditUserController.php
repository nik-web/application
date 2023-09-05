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
use User\Repository\UserInterface;
use User\Form\UserEditForm;
use User\Entity\User;

/**
 * EditUserController
 *
 * @package User\Controller
 */
class EditUserController extends AbstractActionController
{
    /**
     * @var UserInterface
     */
    private $userRepository;
    
    /**
     * @var UserEditForm
     */
    private  $form;


    /**
     * Constructs this controller.
     * 
     * @param UserInterface $userRepository
     * @param UserEditForm $form
     */
    public function __construct(UserInterface $userRepository, UserEditForm $form)
    {
        $this->userRepository = $userRepository;
        $this->form = $form;
    }
    
    /**
     * This action will display the edit user form.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        // Retrieve the current request.
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id');
        $user = $this->userRepository->findUserById($id);
        if (!$user instanceof User ) {
            $message = sprintf(
                'Die Kontodaten mit der ID „%s“ nicht gefunden.', $id
            );
            $this->flashMessenger()->addErrorMessage($message);
            
            return $this->redirect()->toRoute('all-users', []);
        }
        $form = $this->form;
        // Fill in the form with user data
        $data = $user->getArrayCopy();
        $form->setData($data);
        if ($request->isPost()) {            
            // Populate the form with data from the request.
            $form->setData($request->getPost());
            // Validate form
            if($form->isValid()) {                
                $cleanData = $form->getData();                
                $userData = $user->getArrayCopy();                
                // Overwrite with current data
                $userData['status'] = $cleanData['status'];
                $userData['updated_on'] = date('Y-m-d H:i:s');
                // Set current data to the user
                $user->exchangeArray($userData);
                $isUpated = $this->userRepository->update($user);
                if ( $isUpated ) {
                    $message = 'Die Kontodaten wurden geändert.';
                    $this->flashmessenger()->addSuccessMessage($message);
                } else {
                    $message = 'Die Kontodaten wurden nicht geändert.';
                    $this->flashmessenger()->addWarningMessage($message);
                }
                
                return $this->redirect()
                    ->toRoute('user-detail', ['id' => $user->getId(),]);
            }
        }
        
        return new ViewModel([
            'user' => $user,
            'form' => $form,
        ]);
    }
}