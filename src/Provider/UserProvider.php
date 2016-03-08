<?php

namespace Grigoros\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Doctrine\ORM\EntityRepository;

/**
 * UserProvider class.
 *
 * @author Diego de Biagi<diegobiagiviana@gmail.com>
 */
class UserProvider implements UserProviderInterface {
    
    private $repository;
    
    public function __construct() {
        $this->repository;
    }
    
    public function loadUserByUsername($username) {
        
    }

    public function refreshUser(UserInterface $user) {
        
    }

    public function supportsClass($class) {
        
    }

//put your code here
}
