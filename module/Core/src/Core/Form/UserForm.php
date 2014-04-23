<?php

namespace Core\Form;

use Zend\Form\Form;

use Core\Entity\User;

/**
 * User Form Class
 */
class UserForm extends Form
{
    /**
     * @var User
     */
    protected $userEntity;

    /**
     * Constructor method
     */
    public function __construct()
    {
        parent::__construct('user');

        $this->add(array(
            'name' => 'firstname',
        ));

        $this->add(array(
            'name' => 'lastname',
        ));

        $this->add(array(
            'name' => 'email',
        ));

        $this->add(array(
            'name' => 'username',
        ));

        $this->add(array(
            'name' => 'password',
        ));
    }

    /**
     * Setter for the User Entity
     *
     * @param User $userEntity
     */
    public function setUserEntity($userEntity)
    {
        $this->userEntity = $userEntity;
    }

    /**
     * Process form data
     *
     * @param  mixed $data    Form data
     * @param  object $object Type of object to create
     */
    public function process($data, $object = null)
    {
        // If no entity object is passed
        if(!$object) {
            $object = $this->userEntity;
        }

        $this->bind($object);
        $this->setData($data);
    }
}
