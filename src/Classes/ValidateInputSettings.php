<?php

namespace ValidateGetPostInput\Classes;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\Pattern;
use ValidateGetPostInput\Statics\DataType;
use ValidateGetPostInput\Statics\DateFormat;

/**
 * ValidateInputSettings class to store the settings for the validation.
 * 
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2022-12-24
 */
class ValidateInputSettings
{

    /**
     * @var int $input_type The type of input to validate.
     * 0 = $_GET, 
     * 1 = $_POST.
     */
    public int $input_type;
    /**
     * @var bool $required Whether the input is required.
     */
    public bool $required;
    /**
     * @var int $pattern The pattern to validate the input against. 
     * 0 = no pattern, 
     * 1 = validate email.
     */
    public int $pattern;
    /**
     * @var string $regex_pattern The regex pattern to validate the input against.
     */
    public string $regex_pattern;
    /**
     * @var int $data_type The datatype of the input.
     * 0 = string,
     * 1 = integer,
     * 2 = float,
     * 3 = boolean,
     * 4 = json object
     * 5 = date
     */
    public int $data_type;
    /**
     * @var bool $check_min_max Whether to check the minimum and maximum length of the input.
     */
    public bool $check_min_max;
    /**
     * @var int $min The minimum length of the input when the input is a string. Otherwise the minimum value of the input as a number.
     */
    public int $min;
    /**
     * @var int $max The maximum length of the input when the input is a string. Otherwise the maximum value of the input as a number.
     */
    public int $max;
    /**
     * @var bool $trim Whether to trim the input.
     */
    public bool $trim;
    /**
     * @var bool $sanitize Whether to sanitize the input.
     */
    public bool $sanitize;
    /**
     * @var bool $date_format Whether to check if the input is a valid date. (Only works with DataType::DATE)
     */
    public bool $date_format;

    /**
     * Constructor for the ValidateInputSettings class.
     *
     * @param int $input_type The type of input to validate. 0 = $_GET, 1 = $_POST.
     * @param bool $required Whether the input is required.
     * @param int $pattern The pattern to validate the input against. 0 = no pattern, 1 = validate email, 2 = regex pattern.
     * @param string $regex_pattern The regex pattern to validate the input against, only used when $pattern = 2.
     * @param int $data_type The datatype of the input. 0 = string, 1 = integer, 2 = float, 3 = boolean, 4 = json object, 5 = date.
     * @param bool $check_min_max Whether to check the minimum and maximum length of the input. default value is false.
     * @param int $min The minimum length of the input when the input is a string. Otherwise the minimum value of the input as a number. default value is 0.
     * @param int $max The maximum length of the input when the input is a string. Otherwise the maximum value of the input as a number. default value is 0.
     * @param bool $trim Whether to trim the input. default value is true.
     * @param bool $sanitize Whether to sanitize the input. default value is true.
     * @param bool $date_format Whether to check if the input is a valid date. (Only works with DataType::DATE) default value is none.
     */
    public function __construct(
        $input_type = RequestType::GET,
        $required = false,
        $pattern = Pattern::NONE,
        $regex_pattern = "",
        $data_type = DataType::STRING,
        $check_min_max = false,
        $min = 0,
        $max = 0,
        $trim = true,
        $sanitize = true,
        $date_format = DateFormat::NONE
    ) {
        $this->input_type = $input_type;
        $this->required = $required;
        $this->pattern = $pattern;
        $this->regex_pattern = $regex_pattern;
        $this->data_type = $data_type;
        $this->check_min_max = $check_min_max;
        $this->min = $min;
        $this->max = $max;
        $this->trim = $trim;
        $this->sanitize = $sanitize;
        $this->date_format = $date_format;
    }
}
