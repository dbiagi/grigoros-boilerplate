<?php

namespace Controller;

use Application\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of SecurityController
 *
 * @author Diego Biagi <diego.viana@lecom.com.br>
 */
class SecurityController {
    
    public function adminAction(Application $app, Request $request){
        return new Response('Secured Area', 200);
    }
    
}
