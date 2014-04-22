<?php

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Model\JsonModel;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;

use Core\Service\UserServiceInterface;
use Core\Form\UserForm;

/**
 * User Controller Class
 *
 * @see AbstractRestfulController
 */
class UserController extends AbstractRestfulController
{
    /**
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     * @var Core\Form\UserForm
     */
    protected $userForm;

    /**
     * @var array
     */
    protected $allowedCollectionMethods = array(
        'GET',
        'POST',
    );

    /**
     * @var array
     */
    protected $allowedResourceMethods = array(
        'GET',
        'PATCH',
        'PUT',
        'DELETE',
    );

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
     * Setter for the Event Manager
     *
     * @param EventManagerInterface $events
     */
    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
        $events->attach('dispatch', array($this, 'checkOptions'), 10);
    }

    /**
     * Check which HTTP options are allowed
     *
     * @param  MvcEvent $e
     * @return ApiProblemResponse
     */
    public function checkOptions($e)
    {
        $matches  = $e->getRouteMatch();
        $request  = $e->getRequest();
        $method   = $request->getMethod();

        if ($matches->getParam('id', false)) {
            if (!in_array($method, $this->allowedResourceMethods)) {
                 return new ApiProblemResponse(
                    new ApiProblem(405, 'The HTTP method: '.$method.' is not allowed for this URI.')
                );
            }
            return;
        }

        if (!in_array($method, $this->allowedCollectionMethods)) {
            return new ApiProblemResponse(
                new ApiProblem(405, 'The HTTP method '.$method.' is not allowed for this URI.')
            );
        }
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
            return new JsonModel($users);
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
            return new JsonModel($user);
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
        $isValid = false;
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
