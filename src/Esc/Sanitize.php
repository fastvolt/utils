<?php

declare(strict_types=1);

namespace FastVolt\Utils\Esc;

class Sanitize
{
    protected function __construct(
        private string|int|float|array|object $input,
        private bool $strip_tags = false
        // private bool $sanitize_nested_array = false
    ) {
        //
    }


    protected function sanitize(): mixed 
    {
        $input = is_object($this->input) ? (array)$this->input : $this->input;

        // integers operation
        if (is_int($input) && $this->strip_tags == false) {
            return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
        }

        // string operations
        if (is_string($input) && $this->strip_tags == false) {
            return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        }

        if (is_string($input) && $this->strip_tags == true) {
            return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
        }

        // float operation
        if (is_float($input)) {
            return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT);
        }

        /**
        * if (is_array($input) && true === $this->sanitize_nested_array) {

        *    return $this->sanitizeSubArray($input);
        * }
        **/

        return null;
    }



    /**
     * @ignore unused for now
     */
    private function sanitizeSubArray(array $inputs): array
    {
        $all_inputs = [];

        foreach ($inputs as $input) {

            // integers operation
            if (is_int($input)) {
                $all_inputs[] = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
                continue;
            }

            // string operations
            if (is_string($input) && $this->strip_tags = false) {
                $all_inputs[] = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
                continue;
            }

            if (is_string($input) && $this->strip_tags = true) {
                $all_inputs[] = htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
                continue;
            }

            // float operation
            if (is_float($input)) {
                $all_inputs[] = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT);
                continue;
            }

            if (is_object($single_input)) {
                continue;
            }

            if (is_array($input)) {
                $all_inputs[] = $this->sanitizeSubArray($input);
                continue;
            }
        }


        return $all_inputs;
    }
}