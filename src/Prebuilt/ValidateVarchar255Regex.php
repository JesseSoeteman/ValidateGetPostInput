<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\Pattern;
use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\ValidateGetPostInput;
use ValidateGetPostInput\Classes\ValidateInputSettings;

/**
 * ValidateVarchar255Regex class to set the settings for the validation.
 * This class is used to validate a varchar(255) field, with a regex pattern.
 * 
 * - This field is required. (this can be changed)
 * - The text must be a string.
 * - The text must be at least 1 character long.
 * - The text can be at most 255 characters long. (this can be changed)
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateVarchar255Regex extends ValidateGetPostInput
{
    public function __construct($key, $reqex, $request_type = RequestType::GET, $required = true, $max_lenght = 255)
    {
        $settings = new ValidateInputSettings();
        $settings->input_type = $request_type;
        $settings->required = $required;
        $settings->pattern = Pattern::REGEX;
        $settings->regex_pattern = $reqex;
        $settings->data_type = DataType::STRING;
        $settings->check_min_max = true;
        $settings->min = 1;
        $settings->max = $max_lenght;
        parent::__construct($key, $settings);
    }
}

