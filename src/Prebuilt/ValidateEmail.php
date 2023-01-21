<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\Pattern;
use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\ValidateGetPostInput;
use ValidateGetPostInput\Classes\ValidateInputSettings;


/**
 * ValidateEmail class to set the settings for the validation.
 * This class is used to validate an email address.
 * 
 * - The email address must be a string.
 * - The email address must be at least 1 character long.
 * - The email address can be at most 320 characters long.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-19
 */
class ValidateEmail extends ValidateGetPostInput
{
    public function __construct($key, $required = true)
    {
        $settings = new ValidateInputSettings();
        $settings->pattern = Pattern::EMAIL;
        $settings->required = $required;
        $settings->data_type = DataType::STRING;
        $settings->check_min_max = true;
        $settings->min = 1;
        $settings->max = 320;
        parent::__construct($key, $settings);
    }
}
