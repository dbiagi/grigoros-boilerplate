<?php

namespace DBiagi\Application;

use Silex\Application as SilexApplication;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * Description of Main
 *
 * @author Diego Viana <diegobiagiviana@gmail.com>
 */
class Application extends SilexApplication {

    private $srcDir;
    private $configDir;
    private $webDir;
    private $viewDir;
    private $cacheDir;
    private $env;

    /**
     * Application constructor.
     * @param string Application enviroment.
     */
    public function __construct(array $configs) {
        parent::__construct();
        
        $this->env = isset($configs['enviroment']) ? $configs['enviroment'] : '';
        $this->configDir = isset($configs['config_dir']) ? $configs['config_dir'] : '';
        $this->webDir = isset($configs['web_dir']) ? $configs['web_dir'] : '';
        $this->cacheDir = isset($configs['cache_dir']) ? $configs['cache_dir'] : '';
        $this->srcDir = isset($configs['sources_dir']) ? $configs['sources_dir'] : '';
        $this->viewDir = isset($configs['views_dir']) ? $configs['views_dir'] : '';
        
        $this->configureRoutes();
        $this->registerProviders();
        
    }


    private function configureRoutes() {
        $this['routes'] = $this->extend('routes', function (RouteCollection $routes, Application $app) {
            $loader = new YamlFileLoader(new FileLocator($app->getConfigDir()));
            $collection = $loader->load('routes.yml');
            $routes->addCollection($collection);

            return $routes;
        });
    }

    private function registerProviders() {
        $this->register(new \Silex\Provider\DoctrineServiceProvider());
        $this->register(new \Silex\Provider\UrlGeneratorServiceProvider());
        $this->register(new \Silex\Provider\TwigServiceProvider(), [
            'twig.options' => [
                'charset' => 'utf-8',
                'cache' => $this->getCacheDir(),
                'strict_variables' => true,
                'auto_reload' => $this->getEnviroment() == 'dev',
                'debug' => $this->getEnviroment() == 'dev'
            ],
            'twig.path' => $this->getViewDir(),
        ]);
        $this->register(new \Igorw\Silex\ConfigServiceProvider($this->configDir . '/config_' . $this->getEnviroment() . '.yml'));
    }

    /**
     * Get configuration directory absolute path.
     * @return string
     */
    public function getConfigDir() {
        return $this->configDir;
    }

    /**
     * Get the source code directory absolute path.
     * @return string
     */
    public function getSrcDir() {
        return $this->srcDir;
    }

    /**
     * Get web directory absolute path.
     * @return string
     */
    public function getWebDir() {
        return $this->webDir;
    }

    /**
     * Get views directory absolute path.
     * @return string
     */
    public function getViewDir() {
        return $this->viewDir;
    }

    /**
     * Get cache directory absolute path.
     * @return string
     */
    public function getCacheDir() {
        return $this->cacheDir;
    }

    /**
     * Get enviroment.
     * @return string
     */
    public function getEnviroment() {
        return $this->env;
    }

}
