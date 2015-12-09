<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Application\Application;
use Doctrine\DBAL\Connection;

/**
 * Description of IndexController
 *
 * @author Diego Biagi <diegviana@gmail.com>
 */
class IndexController {

    public function indexAction(Application $app, Request $request) {
        /* @var $db Connection */
        $db = $app['db'];

        $sql = 'SELECT * FROM user';
        
        $data = $db->fetchAll($sql);

        $params = [
            'data' => $data
        ];        
        
        /* @var $logger \Monolog\Logger */
        $logger = $app['monolog'];
        
        $logger->addDebug('Test de log.');
        
        $response = new Response($app['twig']->render('Pages/index.html.twig', $params), 200);
        
        $response->setTtl(30);
        
        return $response;
    }

}
