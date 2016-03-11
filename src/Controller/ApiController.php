<?php

namespace Grigoros\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Grigoros\Application;
use Doctrine\DBAL\Connection;

/**
 * Description of IndexController
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class IndexController {

    public function indexAction(Application $app, Request $request) {
        /* @var $db Connection */
        $db = $app['db'];
        
        /* @var $logger \Monolog\Logger */
        $logger = $app['monolog'];
        
        $logger->addDebug('Test de log.');
        
        $response = new Response($app['twig']->render('Pages/index.html.twig'), 200);
        
        $response->setTtl(30);
        
        return $response;
    }

    public function rssAction(Application $app, Request $request){
        $rss = new \SimpleXMLElement('<rss xmlns:atom="http://www.w3.org/2005/Atom"></rss>');
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