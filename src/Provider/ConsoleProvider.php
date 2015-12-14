<?php

namespace Provider;

use Silex\ServiceProviderInterface;
use Application\Application;
use Application\Console as ConsoleApplication;
//use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Description of ConsoleProvider
 *
 * @author Diego Biagi <diegobiagiviana@gmail.com>
 */
class ConsoleProvider implements ServiceProviderInterface {

    public function boot(\Silex\Application $app) {}

    public function register(\Silex\Application $app) {
        $app['console'] = $app->share(function() use ($app) {
            return new ConsoleApplication();
        });
    }
}
