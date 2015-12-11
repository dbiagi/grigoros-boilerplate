<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of TestCommand
 *
 * @author Diego Biagi <diegobiagiviana@gmail.com>
 */
class TestCommand extends Command {

    protected function configure() {
        $this
            ->setName('dbiagi:con')
            ->setDescription('Teste de comando')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Está executando');
    }

}
