<?php

require_once 'Classes/ValidateInputSettings.php';

/** 
 * ValidateGetPostInput class to validate
 * $_GET and $_POST input.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2022-12-24
 */
class ValidateGetPostInput
{

    /**
     * @var string $key The key of the $_GET or $_POST input.
     */
    private string $key = "";
    /**
     * @var string $value The value of the $_GET or $_POST input.
     */
    private string $value = "";
    /**
     * @var ValidateInputSettings $settings The settings for the validation.
     */
    private ValidateInputSettings $settings;

    /**
     * @var array $errors The errors that occurred during validation.
     */
    private $errors = [];

    /**
     * Constructor for the ValidateGetPostInput class.
     *
     * @param string $key The key of the $_GET or $_POST input.
     * @param ValidateInputSettings $settings The settings for the validation.
     */
    public function __construct( $key, $settings) {
        $this->key = $key;
        if (empty($settings)) {
            $this->settings = new ValidateInputSettings();
        } else {
            $this->settings = $settings;
        }
    }

    /**
     * Validate the $_GET or $_POST input.
     *
     * @return array The validation result. An array with elements if there are errors, an empty array if there are no errors.
     */
    public function validate()
    {
        // Getting the value of the $_GET or $_POST input.
        switch ($this->settings->input_type) {
            case get_input:
                if (!isset($_GET[$this->key])) {
                    array_push($this->errors, "This field {$this->key} is required");
                    return $this->errors;
                }
                $this->value = $_GET[$this->key];
                break;
            case post_input:
                if (!isset($_POST[$this->key])) {
                    array_push($this->errors, "This field {$this->key} is required");
                    return $this->errors;
                }
                $this->value = $_POST[$this->key];
                break;
        }

        // Validating the value of the $_GET or $_POST input.
        if ($this->settings->required) {
            if (empty($this->value)) {
                array_push($this->errors, "This field {$this->key} is empty");
            }
        }

        // Validating the value for the set spattern.
        switch ($this->settings->pattern) {
            case validate_email_pattern:
                if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
                    array_push($this->errors, "Invalid email address format in field {$this->key}");
                }
                break;
        }

        // Validating the value for the set min length.
        if ($this->settings->min_length > 0) {
            if (strlen($this->value) < $this->settings->min_length) {
                $plural_suffix = $this->settings->min_length == 1 ? "" : "s";
                array_push($this->errors, "This field {$this->key} must be at least " . $this->settings->min_length . " character{$plural_suffix} long");
            }
        }

        // Validating the value for the set max length.
        if ($this->settings->max_length > 0) {
            if (strlen($this->value) > $this->settings->max_length) {
                $plural_suffix = $this->settings->max_length == 1 ? "" : "s";
                array_push($this->errors, "This field {$this->key} can be at most " . $this->settings->max_length . " character{$plural_suffix} long");
            }
        }

        return $this->errors;
    }
}
