<?php

declare(strict_types=1);

namespace FastVolt\Utils;

class Input extends Input\FormDatas
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
    public static function get(
        string|null $names = null,
        bool $sanitize = true,
        array $filter = []
    ): string|array|object|null {

        return (new parent($_FILES, $_POST)) -> getInput($names, $sanitize);
    }


    public static function has(string|array $names): bool
    {
        return (new parent($_FILES, $_POST)) -> hasInput($names);
    }

}