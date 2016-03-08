<?php

namespace Grigoros\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface, \Serializable {

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
     * Canonical user name.
     * @var string
     */
    protected $usernameCanonical;

    /**
     * User email.
     * @var string
     */
    protected $email;

    /**
     * Roles.
     * @var array
     */
    protected $roles;

    /**
     * Is account locked.
     * @var boolean
     */
    protected $locked;

    /**
     * Is account active.
     * @var boolean
     */
    protected $active;

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

    public function __construct($username) {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();

        $this->username = $username;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function eraseCredentials() {
        
    }

    /**
     * 
     * @return type
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    public function getRoles() {
        $this->roles;
    }

    public function addRole($role) {
        $this->roles[] = $role;

        return $this;
    }

    public function getSalt() {
        return sha1(md5(microtime(true)));
    }

    public function getUsername() {
        $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    public function getUsernameCanonical() {
        return $this->usernameCanonical;
    }

    public function setUsernameCanonical($name) {
        $this->usernameCanonical = $name;

        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }
    
    public function isActive(){
        return $this->active;
    }
    
    public function activate(){
        $this->active = true;
        
        return $this;
    }
    
    public function deactivate(){
        $this->active = false;
        
        return $this;
    }
    
    public function isLocked(){
        return $this->locked;
    }
    
    public function lock(){
        $this->locked = true;
        
        return $this;
    }
    
    public function unlock(){
        $this->locked = false;
        
        return $this;
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->usernameCanonical,
            $this->username,
            $this->password,
            $this->email,
            $this->credentialsExpired,            
        ));
    }

    public function unserialize($serialized) {
        $data = unserialize($serialized);

        list(
            $this->id,
            $this->usernameCanonical,
            $this->username,
            $this->password,
            $this->email,
            $this->credentialsExpired,
        ) = $data;
    }

}
