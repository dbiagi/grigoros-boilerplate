<?php

namespace Grigoros\Entity;

/**
 * User
 */
class User
{
    protected $groups = null;
    
    /**
     * @var integer
     */
    protected $id;


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
}

