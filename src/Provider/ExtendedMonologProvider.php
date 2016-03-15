<?php

namespace Grigoros\Provider;

use Silex\ServiceProviderInterface;
use Application\Application;
use Monolog\Logger;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Description of ExtendedLogProvider
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class ExtendedMonologProvider implements ServiceProviderInterface {
    
    public function register(Application $app) {
        $app->register(new \Silex\Provider\MonologServiceProvider(), [
            'monolog.logfile' => $app->getLogFile()
        ]);
        
        /**
         * @TODO Make this configurable in the yaml file.
         * The developer can create an array of handlers.
         */
        
        $app['monolog'] = $app->share(
            $app->extend('monolog', function($monolog, $app) {
                $mysqlHandler = new \Log\Handler\MySQLHandler(
                    $this['db'],
                    $this['monolog.handler.mysql.table'], 
                    $this['monolog.handler.mysql.extra_fields'] ?: [], 
                    $this['monolog.handler.mysql.level'] ?: Logger::DEBUG,
                    $this['monolog.handler.mysql.bubble']?: true
                );
                
                /* @var $monolog \Monolog\Logger */
                $monolog->pushHandler($mysqlHandler);
                
                return $monolog;
            })
        );
    }

    public function boot(Application $app) {
        $app['monolog']->addDebug('Application has booted.');
    }

}
