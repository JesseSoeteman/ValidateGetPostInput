<?php

namespace ValidateGetPostInput;

use DateTime;
use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\Pattern;
use ValidateGetPostInput\Statics\DataType;
use ValidateGetPostInput\Statics\DateFormat;

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
     * @var string|int|float|bool|object $value The value of the $_GET or $_POST input.
     */
    private string|int|float|bool|object $value;
    /**
     * @var ValidateInputSettings $settings The settings for the validation.
     */
    private ValidateInputSettings $settings;

    /**
     * @var array $errors The errors that occurred during validation.
     */
    private $errors = [];

    /**
     * @var array $PATTERN_DATA_TYPE_COMPATIBILITY The data types that are compatible with the patterns. Pattern::NONE is not included, because it is compatible with all data types.
     */
    private const PATTERN_DATA_TYPE_COMPATIBILITY = [
        Pattern::EMAIL => [DataType::STRING],
        Pattern::REGEX => [DataType::STRING],
    ];

    /**
     * Constructor for the ValidateGetPostInput class.
     *
     * @param string $key The key of the $_GET or $_POST input.
     * @param ValidateInputSettings $settings The settings for the validation.
     */
    public function __construct($key, $settings)
    {
        // Checking if the the value of the key is set.
        $this->key = $key;
        if (empty($settings)) {
            $this->settings = new ValidateInputSettings();
        } else {
            $this->settings = $settings;
        }

        // Setting the default value for the value of the $_GET or $_POST input.
        switch ($this->settings->data_type) {
            case DataType::STRING:
                $this->value = "";
                break;
            case DataType::INTEGER:
                $this->value = 0;
                break;
            case DataType::FLOAT:
                $this->value = 0.0;
                break;
            case DataType::BOOLEAN:
                $this->value = false;
                break;
            case DataType::JSON_OBJECT:
                $this->value = json_decode("{}");
                break;
        }

        // check if the data type is compatible with the pattern.
        if ($this->settings->pattern == Pattern::NONE) {
            return;
        }

        $compatible = false;
        foreach (self::PATTERN_DATA_TYPE_COMPATIBILITY[$this->settings->pattern] as $data_type) {
            if ($data_type == $this->settings->data_type) {
                $compatible = true;
                break;
            }
        }
        if (!$compatible) {
            array_push($this->errors, "The data type `{$this->settings->data_type}` is not compatible with the pattern `{$this->settings->pattern}`");
        }
    }

    /**
     * Validate the $_GET or $_POST input.
     *
     * @return array The validation result. An array with elements if there are errors, an empty array if there are no errors.
     */
    public function validate(): array
    {
        // Getting the value of the $_GET or $_POST input.
        {
            $isset = false;
            switch ($this->settings->input_type) {
                case RequestType::GET:
                    $isset = isset($_GET[$this->key]);
                    if ($isset) {
                        $this->value = $_GET[$this->key];
                    }
                    break;
                case RequestType::POST:
                    $isset = isset($_POST[$this->key]);
                    if ($isset) {
                        $this->value = $_POST[$this->key];
                    }
                    break;
            }
            if (!$isset) {
                if ($this->settings->required) {
                    array_push($this->errors, "This field `{$this->key}` is required");
                    return $this->errors;
                }
                return $this->errors;
            }
        }

        // Trim the value if the trim option is set.
        if ($this->settings->trim) {
            $this->value = trim($this->value);
        }

        // Sanitize the value if the sanitize option is set.
        if ($this->settings->sanitize) {
            $this->value = filter_var($this->value, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->value = strip_tags($this->value);
        }
        
        // Validating the value of the $_GET or $_POST input.
        if ($this->settings->required) {
            if (empty($this->value) && $this->value != "0") {
                array_push($this->errors, "This field `{$this->key}` is empty");
            }
        }

        // Validating the value for the set spattern.
        switch ($this->settings->pattern) {
            case Pattern::EMAIL:
                if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
                    array_push($this->errors, "Invalid email address format in field `{$this->key}`");
                }
                break;
            case Pattern::REGEX:
                if (!preg_match($this->settings->regex_pattern, $this->value)) {
                    array_push($this->errors, "Invalid format in field `{$this->key}`");
                }
                break;
        }

        // Validating the value for the set data type.
        switch ($this->settings->data_type) {
            case DataType::STRING:
                $this->validateString();
                break;
            case DataType::INTEGER:
                $this->validateNumber();
                break;
            case DataType::FLOAT:
                $this->validateNumber(DataType::FLOAT);
                break;
            case DataType::BOOLEAN:
                $this->validateBoolean();
                break;
            case DataType::JSON_OBJECT:
                $this->validateJsonObject();
                break;
            case DataType::DATE:
                $this->validateDate();
                break;
        }
        return $this->errors;
    }

    /**
     * Get the value of the $_GET or $_POST input.
     *
     * @return string|int|float|bool|object The value of the $_GET or $_POST input.
     */
    public function getValue(): string|int|float|bool|object
    {
        return $this->value;
    }

    /**
     * Validate the value of the $_GET or $_POST input as a string.
     *
     */
    private function validateString(): void
    {
        // Check if the value is a string.
        if (!is_string($this->value)) {
            array_push($this->errors, "This field `{$this->key}` is not a string");
        }

        // Check if the value needs to be checked for min and max.
        if (!$this->settings->check_min_max || !$this->settings->min > 0 || !$this->settings->max > 0) {
            return;
        }

        // Validating the value for the set min length.
        if (strlen($this->value) < $this->settings->min) {
            $plural_suffix = $this->settings->min == 1 ? "" : "s";
            array_push($this->errors, "This field `{$this->key}` must be at least " . $this->settings->min . " character{$plural_suffix} long");
        }

        // Validating the value for the set max length.
        if (strlen($this->value) > $this->settings->max) {
            $plural_suffix = $this->settings->max == 1 ? "" : "s";
            array_push($this->errors, "This field `{$this->key}` can be at most " . $this->settings->max . " character{$plural_suffix} long");
        }
    }

    /**
     * Validate the value of the $_GET or $_POST input as an number.
     *
     */
    private function validateNumber($data_type = DataType::INTEGER): void
    {
        // Check if the value is a number.
        if (!is_numeric($this->value)) {
            array_push($this->errors, "This field `{$this->key}` is not a number");
            return;
        }

        if ($data_type == DataType::INTEGER) {
            // Converting the string to an integer.
            $this->value = (int) $this->value;
        } else if ($data_type == DataType::FLOAT) {
            // Check if the value is a float.
            if (!is_float($this->value)) {
                array_push($this->errors, "This field `{$this->key}` is not a float");
                return;
            }
            // Converting the string to a float.
            $this->value = (float) $this->value;
        }

        // Check if the value needs to be checked for min and max.
        if (!$this->settings->check_min_max) {
            return;
        }

        // Validating the value for the set min value.
        if ($this->value < $this->settings->min) {
            array_push($this->errors, "This field `{$this->key}` must be at least " . $this->settings->min);
        }
        // Validating the value for the set max value.
        if ($this->value > $this->settings->max) {
            array_push($this->errors, "This field `{$this->key}` can be at most " . $this->settings->max);
        }
    }

    /**
     * Validate the value of the $_GET or $_POST input as a boolean.
     *
     */
    private function validateBoolean(): void
    {
        // Check if the value is a boolean.
        if (!is_bool($this->value)) {
            array_push($this->errors, "This field `{$this->key}` is not a boolean");
        }

        // Converting the value to a boolean.
        $this->value = (bool) $this->value;
    }

    /**
     * Validate the value of the $_GET or $_POST input as a json object.
     *
     */
    private function validateJsonObject(): void
    {
        $decoded = json_decode($this->value);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            array_push($this->errors, "This field `{$this->key}` is not a json object");
        }

        // Check if there is any data in the json object.
        if (empty($decoded)) {
            array_push($this->errors, "This field `{$this->key}` is empty");
        }

        // Converting the value to a json object.
        $this->value = $decoded;
    }

    /**
     * Validate the value of the $_GET or $_POST input as a date.
     *
     */
    private function validateDate(): void
    {
        if (!$this->settings->date_format == DateFormat::NONE) {
            return;
        }

        $date = DateTime::createFromFormat($this->settings->date_format, $this->value);

        if (!$date || $date->format($this->settings->date_format) != $this->value) {
            array_push($this->errors, "This field `{$this->key}` is not a date");
        }

        // Converting the value to a date.
        $this->value = $date;
    }
}