<?php

declare(strict_types=1);

namespace FastVolt\Utils;

class Esc extends Esc\Sanitize
{
    public static function out(

        /** @var string|int|float|array<string, int, float> */
        string|int|float|array $input,

        /** @var bool */
        bool $strip_tags = true

    ) {

        return (new parent($input, $strip_tags)) -> sanitize();
    }
}