<?php

namespace ValidateGetPostInput;

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\Pattern;

use ValidateGetPostInput\Classes\ValidateInputSettings;

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
    public function __construct($key, $settings)
    {
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
            case RequestType::GET:
                if (!isset($_GET[$this->key])) {
                    if ($this->settings->required) {
                        array_push($this->errors, "This field {$this->key} is required");
                        return $this->errors;
                    }
                    return $this->errors;
                }
                $this->value = $_GET[$this->key];
                break;
            case RequestType::POST:
                if (!isset($_POST[$this->key])) {
                    if ($this->settings->required) {
                        array_push($this->errors, "This field {$this->key} is required");
                        return $this->errors;
                    }
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
            case Pattern::VALIDATE_EMAIL:
                if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
                    array_push($this->errors, "Invalid email address format in field {$this->key}");
                }
                break;
            case Pattern::REGEX:
                if (!preg_match($this->settings->regex_pattern, $this->value)) {
                    array_push($this->errors, "Invalid format in field {$this->key}");
                }
                break;
        }

        if ($this->settings->isString) {
            if (!is_string($this->value)) {
                array_push($this->errors, "This field {$this->key} is not a string");
            }

            // Validating the value for the set min length.
            if ($this->settings->min > 0) {
                if (strlen($this->value) < $this->settings->min) {
                    $plural_suffix = $this->settings->min == 1 ? "" : "s";
                    array_push($this->errors, "This field {$this->key} must be at least " . $this->settings->min . " character{$plural_suffix} long");
                }
            }
    
            // Validating the value for the set max length.
            if ($this->settings->max > 0) {
                if (strlen($this->value) > $this->settings->max) {
                    $plural_suffix = $this->settings->max == 1 ? "" : "s";
                    array_push($this->errors, "This field {$this->key} can be at most " . $this->settings->max . " character{$plural_suffix} long");
                }
            }
        } else {
            // Check if the value is a number.
            if (!is_numeric($this->value)) {
                array_push($this->errors, "This field {$this->key} is not a number");
            }

            // Validating the value for the set min value.
            if ($this->settings->min != null) {
                if ($this->value < $this->settings->min) {
                    array_push($this->errors, "This field {$this->key} must be at least " . $this->settings->min);
                }
            }
    
            // Validating the value for the set max value.
            if ($this->settings->max != null) {
                if ($this->value > $this->settings->max) {
                    array_push($this->errors, "This field {$this->key} can be at most " . $this->settings->max);
                }
            }
        }

        return $this->errors;
    }

    /**
     * Get the value of the $_GET or $_POST input.
     *
     * @return string The value of the $_GET or $_POST input.
     */
    public function getValue()
    {
        return $this->value;
    }
}