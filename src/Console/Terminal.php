<?php

declare(strict_types=1);

namespace FastVolt\Utils\Console;

use Symfony\Component\Console\Application;
use FastVolt\Utils\Console\Commands;


class Terminal
{
    private array $commands = [];

    private function __construct(
        private string $app_name = 'My Console',
        private string $app_version = 'V1.0',
        private bool $auto_exit = false
    ) {
        //
    }

    /**
     * Init Terminal Console Object
     * 
     * @param string $app_name: Your desired app name (this will display at the top of your console interface)
     * @param string|int $app_version set your console app version (V1.0 used by default)
     * @param bool $auto_exit if true, command execution will exit after one operation.
     */
    public static function new(string $app_name = 'My Console', string|int|float $app_version = 'V1.0', bool $auto_exit = false): self
    {
        $app_version = is_int($app_version) || is_float($app_version)
            ? 'V' . (string) $app_version
            : $app_version;

        return new self($app_name, $app_version);
    }

    public function commands(array|string $commands)
    {
        $this->commands = is_string($commands) ? [$commands] : $commands;
        return $this;
    }

    public function deploy(): int
    {
        $app = new Application($this->app_name, $this->app_version);
        $app->addCommands((new Commands($this->commands))->parseCommands());
        $app->setAutoExit($this->auto_exit);
        return $app->run();
    }

    public function save_deploy(): int
    {
        # init app
        $app = new Application($this->app_name, $this->app_version);
        # add commands only when the user sets it
        if (isset($this->commands) && count($this->commands) > 0) {
            $app->addCommands((new Commands($this->commands))->parseCommands());
        }
        # catch exceptions
        $app->setCatchExceptions(true);
        # auto exit
        $app->setAutoExit($this->auto_exit);
        # run application
        return $app->run();
    }
}