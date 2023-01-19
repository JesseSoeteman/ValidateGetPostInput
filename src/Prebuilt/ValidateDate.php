<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\DataType;
use ValidateGetPostInput\Statics\DateFormat;

use ValidateGetPostInput\ValidateGetPostInput;
use ValidateGetPostInput\Classes\ValidateInputSettings;

/**
 * ValidateDate class to set the settings for the validation.
 * This class is used to validate a date.
 * The date must be a string.
 * 
 * On default the date must be in the format YYYY-MM-DD HH:MM:SS.
 * 
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-19
 */
class ValidateDate extends ValidateGetPostInput
{
    public function __construct($key, $request_type = RequestType::GET, $required = true, $date_format = DateFormat::YYYY_MM_DD_HH_MM_SS)
    {
        $settings = new ValidateInputSettings();
        $settings->input_type = $request_type;
        $settings->required = $required;
        $settings->data_type = DataType::DATE;
        $settings->date_format = $date_format;
        parent::__construct($key, $settings);
    }
}

