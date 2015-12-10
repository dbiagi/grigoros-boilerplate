<?php

namespace Application;

use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Description of Console
 *
 * @author Diego Viana <diego.viana@lecom.com.br>
 */
class Console extends ConsoleApplication{
    
    private $name = 'Silex Console';
    
    private $version = '1.0.0';
    
    public function __construct() {
        
        parent::__construct($this->name, $this->version);
        
        $this->initialize();
    }
    
    private function initialize(){
        $this->addCommands([
            /*new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand(),
            new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand(),*/
        ]);
        
        $this->add(new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand('Schema update'));
    }
}
