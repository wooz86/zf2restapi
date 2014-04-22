<?php

namespace Core\InputFilter;

use Zend\InputFilter\InputFilter;

use Core\Repository\UserRepositoryInterface;

class UserInputFilter extends InputFilter
{
    /**
     * @var Core\Repository\UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Setter for the User Repository
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function setUserRepository(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Init method
     */
    public function init()
    {
        $this->add(array(
            'name' => 'firstname',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'Alpha'),
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 255,
                        'message' => 'Firstname must be between 1 and 255 characters.'
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'lastname',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'Alpha'),
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 255,
                        'message' => 'Lastname must be between 1 and 255 characters.'
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'EmailAddress'),
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 255,
                        'message' => 'Email must be between 3 and 255 characters.'
                    ),
                ),
                array(
                    'name' => 'DoctrineModule\Validator\NoObjectExists',
                    'options' => array(
                        'object_repository' => $this->userRepository,
                        'fields'            => 'email',
                        'messages' => array(
                            'objectFound' => 'The email address does already exist.'
                        ),
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'username',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'Alnum'
                ),
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 255,
                        'message' => 'Usernames must not be longer than 255 characters.'
                    ),
                ),
                array(
                    'name' => 'DoctrineModule\Validator\NoObjectExists',
                    'options' => array(
                        'object_repository' => $this->userRepository,
                        'fields'            => 'username',
                        'messages' => array(
                            'objectFound' => 'The username is already taken.'
                        ),
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 8,
                        'max' => 255,
                        'message' => 'Passwords must be between 8 and 255 characters.'
                    ),
                ),
            ),
        ));
    }
}
