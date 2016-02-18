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
        $this->register(new \Silex\Provider\MonologServiceProvider(), [
            'monolog.logfile' => $this->getLogFile()
        ]);
        $this->register(new \Silex\Provider\HttpCacheServiceProvider());
        $this->register(new \Silex\Provider\SecurityServiceProvider());
        $this->register(new \Silex\Provider\RememberMeServiceProvider());
        $this->register(new \Silex\Provider\SessionServiceProvider());
        $this->register(new \Silex\Provider\SerializerServiceProvider());
        $this->register(new \Silex\Provider\DoctrineServiceProvider());    
        $this->register(new \Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider(),[
            'orm.proxies_dir' => $this->rootDir . '/Entity/Proxy',
            'orm.em.options' => [
                'mappings' => [
                    [
                        'type' => 'annotation',
                        'namespace' => 'Entity',
                        'path' => $this->getSrcDir() . '/Entity'
                    ],
                    [
                        'type' => 'annotation',
                        'namespace' => 'Model',
                        'path' => $this->getSrcDir() . '/Model'
                    ],
                    [
                        'type' => 'simple_yml',
                        'namespace' => 'Entity',
                        'path' => $this->getConfigDir() . '/doctrine'
                    ],
                    [
                        'type' => 'simple_yml',
                        'namespace' => 'Model',
                        'path' => $this->getConfigDir() . '/doctrine'
                    ]
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
        return $this->rootDir . '/views';
    }

    /**
     * Get cache directory absolute path.
     * @return string
     */
    public function getCacheDir() {
        $cacheDir = $this->rootDir . '/cache';
        
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
        $logDir = $this->rootDir . '/log';
        $logFile = $logDir . '/' . $this->getEnviroment() . '.log';
        
        //Create dir is not exists
        if(!is_dir($logDir)){
            $this['filesystem']->mkdir($logDir, 0770);
        }
        
        //If on dev env, reset the log file on every request
        if($this->getEnviroment() === Enviroment::DEV){
            $this['filesystem']->dumpFile($logFile, '');
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
    
    /**
     * Get log directory.
     * @return string
     */
    public function getLogDir(){
        return $this->logDir;
    }

}
