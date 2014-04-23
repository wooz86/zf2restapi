<?php

namespace Core\Controller;

use Zend\View\Model\JsonModel;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;

use Core\Service\UserServiceInterface;
use Core\Form\UserForm;

/**
 * User Controller Class
 *
 */
class UserController extends BaseController
{
    /**
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     * @var UserForm
     */
    protected $userForm;

    /**
     * Setter for user service
     *
     * @param UserServiceInterface $userService
     */
    public function setUserService(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Setter for user form
     *
     * @param UserForm $userForm
     */
    public function setUserForm(UserForm $userForm)
    {
        $this->userForm = $userForm;
    }

    /**
     * Fetch all users
     *
     * HTTP GET
     *
     * @return JsonModel array of users
     */
    public function getList()
    {
        $users = $this->userService->findAll();

        if($users) {
            $this->collectionResponse['payload']['data'] = $users;
            $this->collectionResponse['payload']['meta']['total'] = count($users);

            return new JsonModel($this->collectionResponse);
        }

        return new ApiProblemResponse(
            new ApiProblem(404, 'The requested resource could not be found.')
        );
    }

    /**
     * Fetch a single user
     *
     * HTTP GET
     *
     * @param int $id
     * @return JsonModel user
     */
    public function get($id)
    {
        $user = $this->userService->find($id);

        if($user) {
            $this->resourceResponse['payload']['data'] = $user;

            return new JsonModel($this->resourceResponse);
        }

        return new ApiProblemResponse(
            new ApiProblem(404, 'The requested resource with id '.$id.' could not be found.')
        );
    }

    /**
     * Create user
     *
     * HTTP POST
     *
     * @param array $data
     * @return JsonModel result
     */
    public function create($data)
    {
        $this->userForm->process($data);
        $isValid = $this->userForm->isValid();
        $validationMessages = $this->userForm->getMessages();

        if ($isValid) {

            $user = $this->userForm->getData();
            $this->userService->create($user);

            $result = array(
                'success'    => $isValid,
                'created_id' => $user->getId()
            );

            $this->getResponse()->setStatusCode(201);

            return new JsonModel($result);
        }

        return new ApiProblemResponse(
            new ApiProblem(400, $validationMessages)
        );
    }
}
