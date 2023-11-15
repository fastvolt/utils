<?php

declare(strict_types=1);

namespace FastVolt\Utils;

class Input
{
    /**
     * Retrive Form Input Data
     * 
     * # Usage
     * $form = Input::get(['username', 'password'], filters: ['exclude' => ['password']]);
     * $form
     *
     * @param string $names names of values to get e.g Input::get('username')
     * array.
     * @param bool $sanitize sanitize form input data values 
     * 
     * @param array $filters values to exclude from sanitization like password field
     * 
     * @throws \InvalidArgumentException
     *
     * @return object|null
     */
    public function get(
        string|null $names = null,
        bool $sanitize = true,
        array $filter = []
    ): object|null {

        return (new \FastVolt\Utils\Input\FormDatas($_FILES, $_POST)) -> get($names, $sanitize);
    }

}