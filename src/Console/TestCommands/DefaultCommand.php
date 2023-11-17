<?php

declare(strict_types=1);

namespace FastVolt\Utils\Console\TestCommands;

use FastVolt\Utils\Console\TestCommands\FastCommand;

class DefaultCommand extends FastCommand
{
    public function input()
    {
        $this->command->addArgument('make:install', InputOption::VALUE_OPTIONAL);
    }


    public function output()
    {
        $greetings = $this->input->getArgument('make:install');
        
        $this->output->writeln('Installed Succesfully');
    }
}