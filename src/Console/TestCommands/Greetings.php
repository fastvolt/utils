<?php

declare(strict_types=1);

namespace FastVolt\Utils\Console\TestCommands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class Greetings extends Command
{

    public function configure()
    {
        $this->setName('Greetings')->setDescription('Just a Description Test');
        $this->addArgument('name', InputArgument::REQUIRED, 'Input Your Name Here:');
        $this->setHelp('Names to Print');
        $this->
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $arg = $input->getArgument('name');
        
        $output->writeln(sprintf("Welcome, %s", $arg));

        return Command::SUCCESS;
    }
}