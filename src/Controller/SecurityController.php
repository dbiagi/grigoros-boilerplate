<?php

namespace Grigoros\Controller;

use Grigoros\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of SecurityController
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class SecurityController {
    
    public function adminAction(Application $app, Request $request){
        return new Response('Secured Area', 200);
    }
    
}
