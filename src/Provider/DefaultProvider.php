<?php

namespace Grigoros\Provider;

use Silex\ServiceProviderInterface;

/**
 * Provide basic services to the application.
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class DefaultProvider implements ServiceProviderInterface {

    public function boot(\Silex\Application $app) {}

    public function register(\Silex\Application $app) {
        $app['faker'] = $app->share(function() use ($app) {
            $generator = \Faker\Factory::create($app['locale']);
            
            return $generator;
        });
        
        $app['guzzle.client'] = $app->share(function(){
            return new \GuzzleHttp\Client();
        });
    }
}
