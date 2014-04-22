<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * User Doctrine Entity Class
 *
 * @ORM\Entity(repositoryClass="Core\Repository\DoctrineUserRepository")
 * @ORM\Table(name="users")
 **/
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", nullable=false)
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $firstname;

    /** @ORM\Column(type="string") */
    protected $lastname;

    /** @ORM\Column(type="string", unique=true) */
    protected $email;

    /** @ORM\Column(type="string", unique=true) */
    protected $username;

    /** @ORM\Column(type="string") */
    protected $password;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * Set ID
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Firstname
     *
     * @param string $email
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get Firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set Lastname
     *
     * @param string $email
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get Lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set Email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Username
     *
     * @param string $email
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get Username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * Set Password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get Password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Generate a secure password hash
     *
     * @param string
     */
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Get Created date
     *
     * @return object
     */
    public function getCreated()
    {
        return $this->created_at;
    }

    /**
     * Get Updated date
     *
     * @return object
     */
    public function getUpdated()
    {
        return $this->updated_at;
    }

    /**
     * Returns current object properties as an array
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * exchangeArray
     *
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $this->id          = (isset($data['id'])) ? $data['id']: $this->id;
        $this->firstname   = (isset($data['firstname'])) ? $data['firstname']: $this->firstname;
        $this->lastname    = (isset($data['lastname'])) ? $data['lastname']: $this->lastname;
        $this->email       = (isset($data['email'])) ? $data['email']: $this->email;
        $this->username    = (isset($data['username'])) ? $data['username']: $this->username;
        $this->password    = (isset($data['password'])) ? $this->hashPassword($data['password']) : $this->password;
        $this->created_at  = (isset($data['created_at'])) ? $data['created_at']: $this->created_at;
        $this->updated_at  = (isset($data['updated_at'])) ? $data['updated_at']: $this->updated_at;
    }
}
