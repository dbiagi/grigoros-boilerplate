<?php

namespace Grigoros\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

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
                $mysqlHandler = new \Grigoros\Log\Handler\MySQLHandler(
                    $app['db']->getWrappedConnection(), 'log', []
                );
                
                $monolog->pushHandler($mysqlHandler);
                
                return $monolog;
            })
        );
    }

    public function boot(Application $app) {}

}
