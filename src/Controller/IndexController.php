<?php

namespace Grigoros\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Grigoros\Application;
use Doctrine\DBAL\Connection;

/**
 * Description of IndexController
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class IndexController {

    public function indexAction(Application $app, Request $request) {
        return new Response($app['twig']->render('Pages/index.html.twig'), 200);
    }

}
