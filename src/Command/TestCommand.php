<?php

namespace Grigoros\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of TestCommand
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class TestCommand extends Command {

    protected function configure() {
        $this
            ->setName('com')
            ->setDescription('Teste de comando')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Está executando');
        
        $em = $this->getHelper('em');
        
        var_dump($em);
    }

}
