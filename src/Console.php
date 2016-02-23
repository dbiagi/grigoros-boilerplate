<?php

namespace Grigoros;

use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Description of Console
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class Console extends ConsoleApplication {

    private $name = 'Grígoros Console';
    private $version = '0.0.1';
    private $container = null;

    public function __construct(Application $container) {

        parent::__construct($this->name, $this->version);

        $this->container = $container;

        $this->initialize();
    }

    private function initialize() {

        $em = $this->container['orm.em'];

        $helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
            'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
            'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
        ));

        $this->setHelperSet($helperSet);

        $this->addCommands($this->getCommands());
    }

    public function getCommands() {
        return [
            
            // DBAL Commands
            new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
            new \Doctrine\DBAL\Tools\Console\Command\ImportCommand(),
            // ORM Commands
            new \Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand(),
            new \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
            new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand(),
            new \Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand(),
            new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand(),
            new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand(),
            new \Doctrine\ORM\Tools\Console\Command\InfoCommand(),
            new \Grigoros\Command\TestCommand(),
        ];
    }

}
