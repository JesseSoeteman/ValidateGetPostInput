<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\ValidateGetPostInput;
use ValidateGetPostInput\Classes\ValidateInputSettings;

/**
 * ValidateText class to set the settings for the validation.
 * This class is used to validate text.
 * 
 * - The text must be a string.
 * - The text must be at least 1 character long.
 * - The text can be at most 65535 characters long.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateText extends ValidateGetPostInput
{
    public function __construct($key, $required = true, $max_lenght = 65535)
    {
        $settings = new ValidateInputSettings();
        $settings->required = $required;
        $settings->data_type = DataType::STRING;
        $settings->check_min_max = true;
        $settings->min = 1;
        $settings->max = $max_lenght;
        $settings->sanitize = false;
        parent::__construct($key, $settings);
    }
}

