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
        $response = new Response($app['twig']->render('Pages/index.html.twig'), 200);
        
        $response->setTtl(30);
        
        return $response;
    }
    
    public function testAction(Application $app){
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $app['orm.em'];
        
        /* @var $repository \Doctrine\ORM\EntityRepository */
        $repository = $em->getRepository(\Grigoros\Entity\User::class);
        
        $results = $repository->findAll();
        
        return new JsonResponse($results, JsonResponse::HTTP_OK);
    }
}
