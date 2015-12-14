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

    public function rssAction(Application $app, Request $request){
        $rss = new \SimpleXMLElement('<rss xmlns:g="http://base.google.com/ns/1.0" xmlns:c="http://base.google.com/cns/1.0"></rss>');
        $rss->addAttribute('version', '2.0');
        
        $collection = [
            ['Nome' => 'EIIITçã', 'Email' => 'Eita@treta.com', 'Endereco' => 'Botocudos'],
            ['Nome' => 'Oloco áá Bixo', 'Email' => 'Eita@treta.com', 'Endereco' => 'Botocudos'],
            ['Nome' => 'Oloco Bixo', 'Email' => 'Eita@treta.com', 'Endereco' => 'Botocudos'],
            ['Nome' => 'Oloco Bixo', 'Email' => 'Eita@treta.com', 'Endereco' => 'Botocudos'],
            ['Nome' => 'Oloco Bixo', 'Email' => 'Eita@treta.com', 'Endereco' => 'Botocudos'],
            ['Nome' => 'Oloco Bixo', 'Email' => 'Eita@treta.com', 'Endereco' => 'Botocudos'],
            ['Nome' => 'Oloco Bixo', 'Email' => 'Eita@tretaá.com', 'Endereco' => 'Botocudos'],
        ];
        
        foreach($collection as $data){
            $item = $rss->addChild('item');
            
            foreach($data as $title => $value){
                $item->addChild(strtolower($title), $value);
            }
        }
        
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;
        $dom->loadXML($rss->asXML());
        
        $response = new Response($dom->saveXML(), 200, [
            'Content-Type' => 'application/rss+xml'
        ]);
        
        
        return $response;
    }
}
