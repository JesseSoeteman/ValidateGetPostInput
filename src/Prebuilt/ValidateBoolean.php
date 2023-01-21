<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\Classes\ValidateInputSettings;
use ValidateGetPostInput\ValidateGetPostInput;

/**
 * ValidateBoolean class to set the settings for the validation.
 * This class is used to validate a boolean.
 * 
 * - The request type is GET. (this can be changed to POST)
 * - The value is required. (this can be changed)
 * - The value must be a boolean.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-19
 */
class ValidateBoolean extends ValidateGetPostInput
{
    public function __construct($key, $required = true)
    {
        $settings = new ValidateInputSettings();
        $settings->required = $required;
        $settings->data_type = DataType::BOOLEAN;
        parent::__construct($key, $settings);
    }
}