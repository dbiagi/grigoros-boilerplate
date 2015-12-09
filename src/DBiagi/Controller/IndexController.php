<?php

namespace DBiagi\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DBiagi\Application\Application;

/**
 * Description of IndexController
 *
 * @author Diego Biagi <diegobiagiviana@gmail.com>
 */
class IndexController {
    
    public function indexAction(Application $app, Request $request){
        return $app['twig']->render('Pages/index.html.twig');
    }
    
}
