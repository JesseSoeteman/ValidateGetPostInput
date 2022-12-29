<?php

define('get_input', 0);
define('post_input', 1);

define('no_pattern', 0);
define('validate_email_pattern', 1);

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
     * @var int $min_length The minimum length of the input.
     */
    public int $min_length;
    /**
     * @var int $max_length The maximum length of the input.
     */
    public int $max_length;

    /**
     * Constructor for the ValidateInputSettings class.
     *
     * @param int $input_type The type of input to validate. 0 = $_GET, 1 = $_POST.
     * @param bool $required Whether the input is required.
     * @param int $pattern The pattern to validate the input against. 0 = no pattern, 1 = validate email.
     * @param int $min_length The minimum length of the input.
     * @param int $max_length The maximum length of the input.
     */
    public function __construct(
        $input_type = get_input,
        $required = false,
        $pattern = no_pattern,
        $min_length = 0,
        $max_length = 0
    ) {
        $this->input_type = $input_type;
        $this->required = $required;
        $this->pattern = $pattern;
        $this->min_length = $min_length;
        $this->max_length = $max_length;
    }
}
