<?php

declare(strict_types=1);

namespace FastVolt\Utils\Console\TestCommands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\ProgressBar;

class FastCommand
{
    protected Command $command;

    protected InputInterface $input;

    protected OutputInterface $output;

    protected InputOption $option;

    protected  $args;

    protected ProgressBar $progressbar;

    private string $command_name;




    /**
     * Create New Command Name e.g php <file_name> <command_name>
     * 
     * @param string $name input custom command name
     * 
     * @return self
     */
    public function create(string $name): self
    {
        $this->command_name = $name;
        return $this;
    }


    /**
     * Set Command Arguments e.g <file_name> <command_name> <args>
     * 
     * @param string $assign_name this name will be a tag which the console arg input will be binded to
     * @param bool $is_required should this argument be required or not?
     * 
     * @return self
     */
    public function args(string $assign_name, bool $is_required = false): self
    {
        
    }
}