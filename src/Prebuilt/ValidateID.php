<?php

namespace ValidateGetPostInput\Prebuilt;

/**
 * ValidateID class to set the settings for the validation.
 * This class is used to validate an ID.
 * 
 * - The value is required. (this can be changed)
 * - The ID must be a number.
 * - The ID must be at least -1.
 * - The ID can be at most 2147483647.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateID extends ValidateNumber
{
    public function __construct($key, $required = true)
    {
        parent::__construct($key, $required, -1, 2147483647);
    }
}