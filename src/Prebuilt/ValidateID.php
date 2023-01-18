<?php

namespace ValidateGetPostInput\Prebuilt;

define('get_input', 0);
define('post_input', 1);

define('no_pattern', 0);

use ValidateGetPostInput\ValidateGetPostInput;
use ValidateGetPostInput\Classes\ValidateInputSettings;

/**
 * ValidateID class to set the settings for the validation.
 * This class is used to validate an ID.
 * The ID must be a number.
 * The ID must be at least -1.
 * The ID can be at most 2147483647.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateID extends ValidateGetPostInput
{
    public function __construct($key, $request_type = get_input, $required = true)
    {
        $settings = new ValidateInputSettings();
        $settings->input_type = $request_type;
        $settings->required = $required;
        $settings->isString = false;
        $settings->min = -1;
        $settings->max = 2147483647;
        parent::__construct($key, $settings);
    }
}