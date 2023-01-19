<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\Pattern;

use ValidateGetPostInput\ValidateGetPostInput;
use ValidateGetPostInput\Classes\ValidateInputSettings;


/**
 * ValidateEmail class to set the settings for the validation.
 * This class is used to validate an email address.
 * The email address must be a string.
 * The email address must be at least 1 character long.
 * The email address can be at most 320 characters long.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateEmail extends ValidateGetPostInput
{
    public function __construct($key, $request_type = RequestType::GET, $required = true)
    {
        $settings = new ValidateInputSettings();
        $settings->input_type = $request_type;
        $settings->pattern = Pattern::VALIDATE_EMAIL;
        $settings->required = $required;
        $settings->isString = true;
        $settings->min = 1;
        $settings->max = 320;
        parent::__construct($key, $settings);
    }
}
