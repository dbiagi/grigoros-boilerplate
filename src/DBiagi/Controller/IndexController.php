<?php

namespace DBiagi\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DBiagi\Application;

/**
 * Description of IndexController
 *
 * @author Diego Viana <diegobiagiviana@gmail.com>
 */
class IndexController {
    
    public function indexAction(Application $app, Request $request){
        return $app['twig']->render('base.html.twig');
    }
    
}
