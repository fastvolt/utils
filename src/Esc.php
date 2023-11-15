<?php

declare(strict_types=1);

namespace FastVolt\Utils;

class Esc extends Esc\Sanitize
{
    public function out(
        /** @var string|int|float|array<string, int, float> */
        string|int|float|array $input,

        /** @var bool */
        bool $sanitize = true

        /** @var bool */
        // bool $sanitize_nested_array = false
    ) {

        return (new parent($input, $sanitize)) -> sanitize();
    }
}