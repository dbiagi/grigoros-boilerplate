<?php

namespace Provider;

use Silex\ServiceProviderInterface;
use Application\Application;
use Application\Console as ConsoleApplication;

/**
 * Description of ConsoleProvider
 *
 * @author Diego Biagi <diegobiagiviana@gmail.com>
 */
class ConsoleProvider implements ServiceProviderInterface{
    public function boot(\Silex\Application $app) {}

    public function register(Application $app) {
        $app['console'] = $app->share(function() use ($app){
            $consoleApplication = new ConsoleApplication(
                $app['console.name'],
                $app['console.version']
                );
            
        });
    }
}
