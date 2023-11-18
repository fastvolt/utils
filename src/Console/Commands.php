<?php

declare(strict_types=1);

namespace FastVolt\Utils\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\{
    InputOption,
    InputInterface,
    InputArgument
};
use FastVolt\Utils\Console\Exceptions\{
    CommandObjectNotFoundException,
    CommandInputMethodNotFoundException,
    CommandOutputMethodNotFoundException
};

class Commands extends Command
{

    public function __construct(

        /** @var array<string, object>  */
        private array $commands = []

    ) {
        //
    }


    public function parseCommands(): array
    {
        if (isset($this->commands) && count($this->commands) > 0) {

            foreach ($this->commands as $single_command) {

                if (! (is_object($single_command) || is_string($single_command))) {
                    return throw new \InvalidArgumentException(sprintf('Only Object and Strings are allowed as command arguments, %s given', gettype($single_command)));
                }

                if (is_string($single_command)) {
                    $all_command_objects[] = $this->parseStringCommands($single_command);
                }

                if (is_object($single_command)) {
                    $all_command_objects[] = $this->parseObjectCommands($single_command);
                }
            }

            return $all_command_objects;
        }

        return [];
    }


    private function parseStringCommands(string $command): object
    {
        $command_obj = new $command();

        if (! class_exists($command)) {
            return throw new CommandObjectNotFoundException(sprintf('(%s) Command Object Not Found', $command));
        }

        if (!is_object($command_obj)) {
            return throw new \InvalidArgumentException(sprintf('(%s) Object Not Valid', $command));
        }

        # check if config method exist
        if (!method_exists($command_obj, 'config')) {
            return throw new CommandInputMethodNotFoundException(sprintf('Config Method Does Not Exist In (%s) Command Object', $command));
        }

        # check if execute method exist
        if (!method_exists($command_obj, 'exec')) {
            return throw new CommandOutputMethodNotFoundException(sprintf('Exec Method Does Not Exist In (%s) Command Object', $command));
        }

        return $command_obj;
    }


    private function parseObjectCommands(object $command): object
    {
        $reflect = new \ReflectionClass($command);

        $obj_name = $reflect->getName();

        # check if config method exist
        if (!method_exists($command, 'config')) {
            return throw new CommandInputMethodNotFoundException(sprintf('Config Method Does Not Exist In (%s) Command Class Object', $obj_name));
        }

        # check if execute method exist
        if (!method_exists($command, 'exec')) {
            return throw new CommandOutputMethodNotFoundException(sprintf('Exec Method Does Not Exist In (%s) Command Class Object', $obj_name));
        }

        return $command;
    }

}