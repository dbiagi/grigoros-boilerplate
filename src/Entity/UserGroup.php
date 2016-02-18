<?php

namespace Grigoros\Entity;

/**
 * UserGroup
 */
class UserGroup
{
    /**
     * @var integer
     */
    protected $id;
    
    /**
     * Users in Group
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $users = null;
    
    public function __construct() {        
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
    
}

