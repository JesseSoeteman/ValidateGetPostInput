# ValidateGetPostInput
This class can be used to validate POST or GET input values.

## Requirements
There are a couple things you will need in order to use this php class.
- php 5.6
- composer

## How to use ValidateGetPostInput?
You will need to require the autoloader in your code, after that you can 'use' the APIReturn class.
```php
require __DIR__ . '/vendor/autoload.php';

use ValidateGetPostInput\ValidateGetPostInput;
```

### Basic usage

#### Quick Demo 
In this example the script will look for $_POST["username"];

The parameters of ValidateInputSettings:
- The request type, post_request of get_request - get_request on default.
- Is required, true or false - false on default.
- The pattern, no_pattern or validate_email_pattern - no_pattern on default.
- The minimum length, 0 or higher - 0 on default.
- The maximum length, 0 or higher - 0 on default.

The parameters of ValidateGetPostInput:
- The name of the input, "username" in this example.
- The settings of the input, the settings of the input (ValidateInputSettings)

```php 
// username
$username = "";
$errors = [];
{
    $_username_settings = new ValidateInputSettings(
        post_input,
        true,
        no_pattern,
        3,
        20
    );
    $_username = new ValidateGetPostInput(
        "username", 
        $_username_settings
    );
    // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $errors[] = $_username->validate(); 
    $username = $_username->getValue();
}
```

#### __Output__
Below are a couple of examples with the code above.

##### Example 1
Nothing is set.
__Input__
```php
// $_POST["username"] = "";
```
__Output__
```php
$errors = [
    "This field username is required"
];
$username = "";
```

##### Example 2
"username" is set to an empty string.
__Input__
```php
$_POST["username"] = "";
```
__Output__
```php
$errors = [
    "This field username is empty",
    "This field username must be at least 3 characters long"
];
$username = "";
```

##### Example 3
"username" is set to a string with a length of 2.
__Input__
```php
$_POST["username"] = "ab";
```
__Output__
```php
$errors = [
    "This field username must be at least 3 characters long"
];
$username = "ab";
```

##### Example 4
"username" is set to a string with a length of 3.
__Input__
```php
$_POST["username"] = "abc";
```
__Output__
```php
$errors = [];
$username = "abc";
```

### Advanced usage

#### Quick Demo
In this example the script will look for $_POST["username"] and $_POST["email"];

```php 
$errors = [];

// username
$username = "";
{
    $_username_settings = new ValidateInputSettings(
        post_input,
        true,
        no_pattern,
        3,
        20
    );
    $_username = new ValidateGetPostInput(
        "username", 
        $_username_settings
    );
    // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $errors[] = $_username->validate(); 
    // This returns the value of the input, if the input is not set it will return an empty string.
    $username = $_username->getValue();
}

// email
$email = "";
{
    $_email_settings = new ValidateInputSettings(
        post_input,
        true,
        validate_email_pattern,
        3,
        50
    );
    $_email = new ValidateGetPostInput(
        "email", 
        $_email_settings
    );
    // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $errors[] = $_email->validate(); 
    // This returns the value of the input, if the input is not set it will return an empty string.
    $email = $_email->getValue();
}

// Check if there are any errors
if (count($errors) > 0) {
    // There are errors
    // Do something with the errors
}

// There are no errors
// Do something with the inputs
```

This way you can validate multiple inputs at once. And get one array with all the errors.

## License

This project is licensed under the [MIT](license)
 License - see the [LICENSE](license) file for
details
