<?php

declare(strict_types=1);

namespace FastVolt\Utils\Input;


class FormDatas
{
    protected function __construct(

        /** @var array<array, string> */
        private array $files,

        /** @var array<string, mixed> */
        private array $post

    ) {
        //
    }


    protected function hasInput(string|array $names): bool
    {
        if (is_object($this->getFormDataArray(true))) {

            if (is_string($names)) {

                return array_key_exists($names, (array) $this->getFormDataArray(true));

            } elseif (is_array($names)) {

                foreach ($names as $single) {
                    if (array_key_exists($single, (array) $this->getFormDataArray(true))) {
                        continue;
                    } else {
                        return false;
                    }
                }

                return true;
            }
        }

        return false;
    }


    protected function getInput(string|array|null $name = null, bool $sanitize)
    {
        return !is_null($name)
            ? self::getSpecificFormData($name, $sanitize)
            : self::getFormDataArray($sanitize);
    }



    /**
     * Retrive Form Post Data For Specific Inputs
     *
     * @param string $names A string representing the name of the parameter to retrieve from the
     * array.
     * @param bool $action A boolean value that determines whether or not to apply htmlspecialchars()
     * function to the retrieved data. If it is set to true, the function will apply htmlspecialchars() to
     * the retrieved data, otherwise it will return the data as it is.
     * 
     * @throws \InvalidArgumentException
     *
     * @return  object|null
     */
    private function getSpecificFormData(string|array $names, bool $action = true): string|array|null
    {
        if (is_object($this->getFormDataArray($action))) {

            # init std class
            $object = new \stdClass;
            # convert string values to array
            $names = is_string($names) ? [$names] : $names;
            
            # get all post and files and convert to array
            $all_post_datas = (array) $this->getFormDataArray($action);

            if (! $this->hasInput($names)) {
                return throw new \InvalidArgumentException('Input Data Does Not Exist in Request Header');  
            }

            print_r($all_post_datas[$names]);

            if (is_string($names)) {

                $result = $this->getFormDataArray($action)->$names;

            } elseif (is_array($names)) {
                # where to store filtered datas
                $result = [];

                foreach ($names as $single) {
                    $result[$single] = $all_post_datas[$single]; 
                }
            }

            return $result;
        }

        return null;
    }



    /**
     * Retrieve Request POST Data Array
     *
     * @param bool  $action: A boolean value that determines whether or not to apply htmlspecialchars()
     * function to the retrieved data. If it is set to true, the function will apply htmlspecialchars() to
     * the retrieved data, otherwise it will return the data as it is.
     *
     * @return ?object
     */
    private function getFormDataArray(bool $action): ?object
    {
        $item = [];
        $all_datas = [];
        $object = new \stdClass();

        # map request array files to post items data arrray if file exist
        if (isset($this->files)) {

            foreach ($this->files as $key => $value) {
                $all_datas[$key] = $value;
            }
        }

        # loop through post datas and sanitize data if the option is enabled
        foreach ($this->post as $key => $value) {
            $all_datas[$key] = match ($action) {
                true => \FastVolt\Utils\Esc::out($value),
                false => $value
            };
        }

        # loop and convert all datas to object
        foreach ($all_datas as $key => $item) {
            $object->$key = $item;
        }

        return (object) $object;
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
            if (is_string($input) && $strip_tags = false) {
                $all_inputs[] = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
                continue;
            }

            if (is_string($input) && $strip_tags = true) {
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