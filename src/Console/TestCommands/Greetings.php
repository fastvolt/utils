<?php

declare(strict_types=1);

namespace FastVolt\Utils\Console\TestCommands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\ProgressBar;

class Greetings extends Command
{

    public function configure()
    {
        $this->setName('fs')->setDescription('Just a Description Test');
        $this->addArgument('name', InputArgument::REQUIRED, 'Input Your Name Here:');
        $this->setHelp('Names to Print');
        $this->addOption('tag', 't', InputOption::VALUE_REQUIRED, 'List Out Tags you are willing to use, separated by comma');
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $arg = $input->getArgument('name');
        $tags = explode(',', $input->getOption('tag'));

        $output->writeln(sprintf("Hello Mr %s, Here are your Tags:", $arg) . PHP_EOL);

        $progress = new ProgressBar($output, count($tags));
        $progress->start();

        if (is_array($tags)) {

            foreach ($tags as $s) {
                sleep(1);
                $output->writeln(sprintf(" Tag: %s \n\n", $s));
                $progress->advance(1);
            }

            $progress->finish();
        }

        $output->writeln(' Operation Successful');

        return Command::SUCCESS;
    }
}