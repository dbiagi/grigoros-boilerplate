<?php

namespace Grigoros\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Grigoros\Application;

/**
 * Description of IndexController
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class ApiController {

    public function testAction(Request $request) {
        $filtred = array_map('utf8_encode', $request->request->all());
        
        $response = new JsonResponse($filtred, Response::HTTP_OK);

        return $response;
    }

    public function jsonAction(Application $app) {
        /* @var $client \GuzzleHttp\Client */
        $client = $app['guzzle.client'];

        $response = $client->request('POST', 'http://192.168.3.83/atosbpm/ws/loginjson', [
            'form_params' => [
                'login' => 'adm',
                'senha' => 'adm'
            ]
        ]);

        $content = $response->getBody();

        return new Response($content, Response::HTTP_OK);
    }

}
