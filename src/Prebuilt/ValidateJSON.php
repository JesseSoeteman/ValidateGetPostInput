<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\Classes\ValidateInputSettings;
use ValidateGetPostInput\ValidateGetPostInput;

/**
 * ValidateJSON class to set the settings for the validation.
 * This class is used to validate a JSON object.
 * 
 * - The value is required. (this can be changed)
 * - The value must be a JSON object.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-19
 */
class ValidateJSON extends ValidateGetPostInput
{
    public function __construct($key, $required = true)
    {
        $settings = new ValidateInputSettings();
        $settings->required = $required;
        $settings->data_type = DataType::JSON_OBJECT;
        $settings->sanitize = false;
        parent::__construct($key, $settings);
    }
}