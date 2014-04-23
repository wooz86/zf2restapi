<?php

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;

/**
 * Base Controller Class
 *
 * @see AbstractRestfulController
 */
class BaseController extends AbstractRestfulController
{
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
     * @var array
     */
    protected $collectionResponse = array(
        'payload' => array(
            'data' => array(),
            'meta' => array('total' => 0)
        )
    );

    /**
     * @var array
     */
    protected $resourceResponse = array(
        'payload' => array(
            'data' => array(),
        )
    );

    /**
     * Setter for the Event Manager
     *
     * @param EventManagerInterface $events
     * @return void
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
    public function checkOptions(MvcEvent $e)
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
        }

        if (!in_array($method, $this->allowedCollectionMethods)) {
            return new ApiProblemResponse(
                new ApiProblem(405, 'The HTTP method '.$method.' is not allowed for this URI.')
            );
        }

        return null;
    }
}
