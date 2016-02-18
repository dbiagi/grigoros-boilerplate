<?php

namespace Grigoros\Provider;

use Silex\ServiceProviderInterface;
use Grigoros\Console as ConsoleApplication;

/**
 * Description of ConsoleProvider
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class ConsoleProvider implements ServiceProviderInterface {

    public function boot(\Silex\Application $app) {}

    public function register(\Silex\Application $app) {
        $app['console'] = $app->share(function() use ($app) {
            return new ConsoleApplication($app);
        });
    }
}
