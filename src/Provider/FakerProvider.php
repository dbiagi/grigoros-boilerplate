<?php

namespace Provider;

use Silex\ServiceProviderInterface;

/**
 * Description of FakerProvider
 *
 * @author Diego Viana <diego.viana@lecom.com.br>
 */
class FakerProvider implements ServiceProviderInterface {

    public function boot(\Silex\Application $app) {}

    public function register(\Silex\Application $app) {
        $app['faker'] = $app->share(function() use ($app) {
            $generator = \Faker\Factory::create($app['locale']);
            
            
            foreach($this->getFakerProviders() as $provider){
                $generator->addProvider($provider);
            }
            
            return $generator;
        });
    }
    
    /**
     * Get custom fake providers.
     * @return array
     */
    private function getFakerProviders(){
        return [
            
        ];
    }

}
