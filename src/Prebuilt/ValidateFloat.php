<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\Classes\ValidateInputSettings;
use ValidateGetPostInput\ValidateGetPostInput;

/**
 * ValidateFloat class to set the settings for the validation.
 * This class is used to validate a floating point number.
 * 
 * - The value must be a number.
 * - The request type is GET. (this can be changed to POST)
 * - The value is required. (this can be changed)
 * - The value must be at least -2147483648. (this can be changed)
 * - The value can be at most 2147483647. (this can be changed)
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateFloat extends ValidateGetPostInput
{
    public function __construct($key, $request_type = RequestType::GET, $required = true, $min = -2147483648, $max = 2147483647)
    {
        $settings = new ValidateInputSettings();
        $settings->input_type = $request_type;
        $settings->required = $required;
        $settings->data_type = DataType::FLOAT;
        $settings->check_min_max = true;
        $settings->min = $min;
        $settings->max = $max;
        parent::__construct($key, $settings);
    }
}
