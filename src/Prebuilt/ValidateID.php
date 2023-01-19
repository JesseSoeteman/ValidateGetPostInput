<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\Classes\ValidateInputSettings;
use ValidateGetPostInput\ValidateGetPostInput;

/**
 * ValidateID class to set the settings for the validation.
 * This class is used to validate an ID.
 * 
 * - The request type is GET. (this can be changed to POST)
 * - The value is required. (this can be changed)
 * - The ID must be a number.
 * - The ID must be at least -1.
 * - The ID can be at most 2147483647.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateID extends validateNumber
{
    public function __construct($key, $request_type = RequestType::GET, $required = true)
    {
        parent::__construct($key, $request_type, $required, -1, 2147483647);
    }
}