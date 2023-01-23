<?php

namespace ValidateGetPostInput;

/**
 * ValidateMultiple class to validate multiple inputs.
 * 
 * This class is used to validate multiple inputs at once.
 * 
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-21
 */
class ValidateMultiple
{
    /**
     * @var array $validations The validations to validate. Strored by key.
     */
    private array $validations = array();
    /**
     * @var array $errors The errors of the validations all together.
     */
    private array $errors = array();
    /**
     * @var array $values The values of the validations. Strored by key.
     */
    private array $values = array();


    /**
     * Constructor of the ValidateMultiple class.
     * 
     * @param array $validations The validations to validate.
     * 
     * @throws \Exception When the validation is not an instance of ValidateGetPostInput.
     * @throws \Exception When the key is already in use.
     */
    public function __construct(array $validations)
    {
        // Validate the validations and store them by key.
        foreach ($validations as $validation) {
            if (!($validation instanceof ValidateGetPostInput)) {
                throw new \Exception("The validation must be an instance of ValidateGetPostInput. (ValidateMultiple)");
            }
            $key = $validation->getKeyValue();

            if (array_key_exists($key, $this->validations)) {
                throw new \Exception("The key '$key' is already in use. (ValidateMultiple)");
            }

            $this->validations[$key] = $validation;
        }
    }

    /**
     * Validate the validations and store the errors and values.
     * 
     * @return array The errors of the validations all together.
     */
    public function validate()
    {
        $this->errors = array();
        $this->values = array();

        foreach ($this->validations as $key => $validation) {
            $this->errors = array_merge($this->errors, $validation->validate());
            $this->values[$validation->getKeyValue()] = $validation->getValue();
        }

        return $this->errors;
    }

    /**
     * Get the value of a validation.
     * 
     * @param string $key The key of the validation.
     * 
     * @return mixed The value of the validation.
     * 
     * @throws \Exception When the key does not exist.
     */
    public function getValue(string $key)
    {
        if (!isset($this->values[$key])) {
            throw new \Exception("The key '$key' does not exist. (ValidateMultiple)");
        }

        return $this->values[$key];
    }

    /**
     * Get the values of the validations all together.
     * 
     * @return array The values of the validations all together stored by key.
     */
    public function getValues()
    {
        return $this->values;
    }
}