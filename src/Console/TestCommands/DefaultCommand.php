<?php

declare(strict_types=1);

namespace FastVolt\Utils\Console\TestCommands;

use FastVolt\Utils\Console\FastCommand;
use FastVolt\Utils\Console\Traits\FastCommandTrait;

class DefaultCommand extends FastCommand
{
    use FastCommandTrait;

    public function config()
    {
        $this->setName('install');
        $this->setDescription('Install Fastvolt Application');
        $this->addArgument('version', $this->inputArgs::VALUE_OPTIONAL, 'Application Version Number');
    }


    public function exec()
    {
        $greetings = $this->input->getArgument('make:install');
        
        $this->output->writeln('Installed Succesfully');
    }
}