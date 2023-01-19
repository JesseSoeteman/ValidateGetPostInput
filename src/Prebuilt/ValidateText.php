<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;

use ValidateGetPostInput\ValidateGetPostInput;
use ValidateGetPostInput\Classes\ValidateInputSettings;

/**
 * ValidateText class to set the settings for the validation.
 * This class is used to validate text.
 * The text must be a string.
 * The text must be at least 1 character long.
 * The text can be at most 65535 characters long.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateText extends ValidateGetPostInput
{
    public function __construct($key, $request_type = RequestType::GET, $required = true, $max_lenght = 65535)
    {
        $settings = new ValidateInputSettings();
        $settings->input_type = $request_type;
        $settings->required = $required;
        $settings->isString = true;
        $settings->min = 1;
        $settings->max = $max_lenght;
        parent::__construct($key, $settings);
    }
}

/**
 * ValidateVarchar255 class to set the settings for the validation.
 * This class is used to validate text.
 * The text must be a string.
 * The text must be at least 1 character long.
 * The text can be at most 255 characters long.
 * This class is used to validate a varchar(255) field.
 * 
 */
class ValidateVarchar255 extends ValidateText
{
    public function __construct($key, $request_type = RequestType::GET, $required = true)
    {
        parent::__construct($key, $request_type, $required, 255);
    }
}

