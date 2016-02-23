<?php

namespace Grigoros\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;


/**
 * User
 */
class User implements UserInterface
{
    /**
     *  User groups.
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $groups = null;
    
    /**
     * @var integer
     */
    protected $id;
    
    /**
     * Password.
     * @var string
     */
    protected $password;
    
    /**
     * User name.
     * @var string
     */
    protected $username;

    /**
     * Roles.
     * @var array
     */
    protected $roles;
    
    /**
     * Is account locked.
     * @var boolean
     */
    protected $isLocked;
    
    /**
     * Is account active.
     * @var boolean
     */
    protected $isActive;
    
    /**
     * Date of user creation.
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Date of last login.
     * @var \DateTime
     */
    protected $lastLoginAt;



    public function __construct() {
        parent::__construct();
        
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function eraseCredentials() {}

    /**
     * 
     * @return type
     */
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password){
        $this->password = $password;
        
        return $this;
    }

    public function getRoles() {
        $this->roles;
    }
    
    public function addRole($role){
        $this->roles[] = $role;
        
        return $this;
    }

    public function getSalt() {
        return sha1(md5(microtime(true)));
    }

    public function getUsername() {
        $this->username;
    }
    
    public function setUsername($username){
        $this->username = $username;
        
        return $this;
    }
    
    

}

