<?php

namespace DBiagi;

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

    private $srcDir = __DIR__;
    private $configDir = __DIR__ . '/../../config';
    private $webDir = __DIR__ . '/../../web';
    private $viewDir = __DIR__ . '/Resources/views';
    private $cacheDir = __DIR__ . '/../../cache/twig';
    private $env;

    /**
     * Application constructor.
     * @param string Application enviroment.
     */
    public function __construct($enviroment = 'dev') {
        parent::__construct();
        $this->env = $enviroment;
        $this->configureRoutes();
        $this->registerProviders();
        $this->configure();
    }

    private function configure() {
        $this['debug'] = true;
    }

    private function configureRoutes() {
        $this['routes'] = $this->extend('routes', function (RouteCollection $routes, \DBiagi\Application $app) {
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
