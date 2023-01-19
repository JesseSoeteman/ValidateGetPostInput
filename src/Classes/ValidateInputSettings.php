<?php

namespace ValidateGetPostInput\Classes;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\Pattern;

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
     * @var int $input_type The type of input to validate. get_input = $_GET, post_input = $_POST.
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
     * @var bool $isString Whether the input is a string or a number.
     */
    public bool $isString;
    /**
     * @var int $min The minimum length of the input when the input is a string. Otherwise the minimum value of the input as a number.
     */
    public int $min;
    /**
     * @var int $max The maximum length of the input when the input is a string. Otherwise the maximum value of the input as a number.
     */
    public int $max;

    /**
     * Constructor for the ValidateInputSettings class.
     *
     * @param int $input_type The type of input to validate. 0 = $_GET, 1 = $_POST.
     * @param bool $required Whether the input is required.
     * @param int $pattern The pattern to validate the input against. 0 = no pattern, 1 = validate email, 2 = regex pattern.
     * @param string $regex_pattern The regex pattern to validate the input against, only used when $pattern = 2.
     * @param bool $isString Whether the input is a string or a number.
     * @param int $min The minimum length of the input when the input is a string. Otherwise the minimum value of the input as a number. default value is 0.
     * @param int $max The maximum length of the input when the input is a string. Otherwise the maximum value of the input as a number. default value is 0.
     */
    public function __construct(
        $input_type = RequestType::GET,
        $required = false,
        $pattern = Pattern::NO_PATTERN,
        $regex_pattern = "",
        $isString = true,
        $min = 0,
        $max = 0
    ) {
        $this->input_type = $input_type;
        $this->required = $required;
        $this->pattern = $pattern;
        $this->regex_pattern = $regex_pattern;
        $this->isString = $isString;
        $this->min = $min;
        $this->max = $max;
    }
}
