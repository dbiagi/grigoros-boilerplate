<?php

namespace Grigoros;

use Silex\Application as SilexApplication;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Description of Main
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class Application extends SilexApplication {

    /**
     * Absolute root dir path.
     * @var string
     */
    private $rootDir;
    
    /**
     * Enviromment variable.
     * @var string
     */
    private $env;
    
    /**
     * Application constructor.
     * @param string Application enviroment.
     */
    public function __construct($enviroment, $rootDir) {
        parent::__construct();
        
        $this->env = $enviroment;
        $this->rootDir = $rootDir;
        
        $this->configureRoutes();
        $this->registerServices();
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

    /**
     * Register the providers.
     * @return void
     */
    private function registerProviders() {
        
        
        $this->register(new \Igorw\Silex\ConfigServiceProvider($this->getConfigDir() . '/config_' . $this->getEnviroment() . '.yml'));
        $this->register(new \Igorw\Silex\ConfigServiceProvider($this->getConfigDir() . '/security' . '.yml'));
        
        $this->register(new \Silex\Provider\HttpCacheServiceProvider());
        $this->register(new \Silex\Provider\SecurityServiceProvider());
        $this->register(new \Silex\Provider\RememberMeServiceProvider());
        $this->register(new \Silex\Provider\SessionServiceProvider());
        $this->register(new \Silex\Provider\SerializerServiceProvider());
        $this->register(new \Silex\Provider\DoctrineServiceProvider());    
        
        $this->register(new \Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider(),[
            'orm.proxies_dir' => $this->getConfigDir() . '/proxy',
            'orm.em.options' => [
                'mappings' => [
                    [
                        'type' => 'annotation',
                        'namespace' => 'Grigoros\\Entity',
                        'path' => $this->getSrcDir() . '/Entity'
                    ],
                    /*[
                        'type' => 'annotation',
                        'namespace' => 'Grigoros\\Model',
                        'path' => $this->getSrcDir() . '/Model'
                    ],*/
                    [
                        'type' => 'simple_yml',
                        'namespace' => 'Grigoros\\Entity',
                        'path' => $this->getConfigDir() . '/doctrine'
                    ],
                    /*[
                        'type' => 'simple_yml',
                        'namespace' => 'Grigoros\\Model',
                        'path' => $this->getConfigDir() . '/doctrine'
                    ]*/
                ]
            ]
        ]);
        $this->register(new \Silex\Provider\TwigServiceProvider(), [
            'twig.options' => [
                'charset' => 'utf-8',
                'cache' => $this->getCacheDir(),
                'strict_variables' => true,
                'auto_reload' => $this->getEnviroment() === Enviroment::DEV,
                'debug' => $this->getEnviroment() === Enviroment::DEV
            ],
            'twig.path' => $this->getViewDir(),
        ]);
        $this->register(new \Silex\Provider\HttpCacheServiceProvider(), [
            'http_cache.cache_dir' => $this->getCacheDir()
        ]);
        $this->register(new \Silex\Provider\UrlGeneratorServiceProvider());
        
        
        $this->register(new \Grigoros\Provider\ConsoleProvider());
        $this->register(new \Grigoros\Provider\ExtendedMonologProvider());
    }

    /**
     * Register services.
     * @return void
     */
    private function registerServices(){
        //Register filesystem service
        $this['filesystem'] = $this->share(function(){
            return new Filesystem();
        });
    }
    
    /**
     * Get configuration directory absolute path.
     * @return string
     */
    public function getConfigDir() {
        return $this->rootDir . '/config';
    }

    /**
     * Get the source code directory absolute path.
     * @return string
     */
    public function getSrcDir() {
        return $this->rootDir . '/src';
    }

    /**
     * Get web directory absolute path.
     * @return string
     */
    public function getWebDir() {
        return $this->rootDir . '/web';
    }

    /**
     * Get views directory absolute path.
     * @return string
     */
    public function getViewDir() {
        return $this->rootDir . '/resources/views';
    }

    /**
     * Get cache directory absolute path.
     * @return string
     */
    public function getCacheDir() {
        $cacheDir = $this->getTmpDir() . '/cache';
        
        if(!is_dir($cacheDir)){
            $this['filesystem']->mkdir($cacheDir, 0770);
        }
        
        return $cacheDir;
    }
    
    /**
     * Get log file path.
     * @return string
     */
    public function getLogFile(){
        $logDir = $this->getTmpDir() . '/log';
        $logFile = $logDir . '/' . $this->getEnviroment() . '.log';
        
        //Create dir is not exists
        if(!is_dir($logDir)){
            $this['filesystem']->mkdir($logDir, 0770);
        }
                
        return $logFile;
    }

    /**
     * Get enviroment.
     * @return string
     */
    public function getEnviroment() {
        return $this->env;
    }

    public function getTmpDir(){
        $tmpDir = $this->rootDir . '/tmp';
        
        if(!is_dir($tmpDir)){
            $this['filesystem']->mkdir($tmpDir, 0770);
        }
        
        return $tmpDir;
    }
}
