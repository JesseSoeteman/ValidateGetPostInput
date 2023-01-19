<?php

namespace ValidateGetPostInput\Prebuilt;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\DataType;

use ValidateGetPostInput\Classes\ValidateInputSettings;
use ValidateGetPostInput\ValidateGetPostInput;

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