<?php

declare(strict_types=1);

namespace FastVolt\Utils\Console\Traits;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\ProgressBar;

trait FastCommandTrait 
{
        /** Base class for all commands. */
        protected Command $config;

        /** InputInterface is the interface implemented by all input classes. */
        protected InputInterface $input;
    
        /** OutputInterface is the interface implemented by all Output classes. */
        protected OutputInterface $output;
    
        /** The ProgressBar provides helpers to display progress output. */
        protected ProgressBar $progressbar;
    
        /** Represents a command line argument. */
        protected InputArgument $inputArgs;
    
        /** Represents a command line option. */
        protected InputOption $InputOpts;
    
}