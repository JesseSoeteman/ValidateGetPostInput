<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\Classes\ValidateInputSettings;
use ValidateGetPostInput\ValidateGetPostInput;

/**
 * ValidateJSON class to set the settings for the validation.
 * This class is used to validate a JSON object.
 * 
 * - The request type is GET. (this can be changed to POST)
 * - The value is required. (this can be changed)
 * - The value must be a JSON object.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-19
 */
class ValidateJSON extends ValidateGetPostInput
{
    public function __construct($key, $request_type = RequestType::GET, $required = true)
    {
        $settings = new ValidateInputSettings();
        $settings->input_type = $request_type;
        $settings->required = $required;
        $settings->data_type = DataType::JSON_OBJECT;
        parent::__construct($key, $settings);
    }
}