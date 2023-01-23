<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Prebuilt\ValidateText;

/**
 * ValidateVarchar255 class to set the settings for the validation.
 * This class is used to validate a varchar(255) field.
 * 
 * - The text must be a string.
 * - The text must be at least 1 character long.
 * - The text can be at most 255 characters long.
 * 
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-19
 */
class ValidateVarchar255 extends ValidateText
{
    public function __construct($key, $required = true)
    {
        parent::__construct($key, $required, 255);
    }
}