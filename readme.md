# ValidateGetPostInput
This php library should help you validate your input from GET and POST requests.<br/>
It will also help you sanitize your input.


## requirements
The following requirements are needed to use this library:
- PHP 8.0 or higher
- Composer

## Installation
To install this library, run the following command in your terminal:
```bash
composer require jessesoeteman/validate-get-post-input
```
Make sure you have composer installed on your system. And to include the autoloader in your code.
```php
require __DIR__ . '/vendor/autoload.php';
```

## How to use ValidateGetPostInput?

### Basic usage

Below are a couple of examples with prebuilt classes these make it easier to use the library.<br/>
The prebuilt classes are:
- [ValidateBoolean](#validateboolean)
- [ValidateNumber](#validatenumber)
- [ValidateFloat](#validatefloat)
- [ValidateText](#validatetext)
- [ValidateJSON](#validatejson)
- [ValidateID](#validateid)
- [ValidateEmail](#validateemail)
- [ValidateVarchar255](#validatevarchar255)
- [ValidateVarchar255Regex](#validatevarchar255regex)
- [ValidateDate](#validatedate)
 
### General information
The prebuilt classes except for the [ValidateVarchar255Regex](#validatevarchar255regex) class, will will have the following parameters as the first parameters in the constructor:
- The name of the input, so if you want to validate $_GET["username"] you would use "username" as the first parameter.
- The request type, default is RequestType::GET, you can use RequestType::POST to validate $_POST["username"].
- If the input is required, default is true.

### ValidateBoolean
```php
use ValidateGetPostInput\Prebuilt\ValidateBoolean;

$boolean = false;
{
    $_boolean = new ValidateBoolean("boolean"); // The name of the input, so $_GET["boolean"]
    $errors[] = $_boolean->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $boolean = $_boolean->getValue(); // This returns the value of the input.
}
```

To use a post request instead of a get request, you can use the second parameter of the constructor. <br/> 
The third parameter is if the input is required, default is true.
```php
use ValidateGetPostInput\Prebuilt\ValidateBoolean;
use ValidateGetPostInput\Statics\RequestType;

$boolean = false;
{
    $_boolean = new ValidateBoolean("boolean", RequestType::POST, false); // The name of the input, so $_POST["boolean"]
    $errors[] = $_boolean->validate(); 
    $boolean = $_boolean->getValue();
}
```



### ValidateNumber
```php
use ValidateGetPostInput\Prebuilt\ValidateNumber;

$number = 0;
{
    $_number = new ValidateNumber("number"); // The name of the input, so $_GET["number"]
    $errors[] = $_number->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $number = $_number->getValue(); // This returns the value of the input.
}
```

### ValidateFloat
```php
use ValidateGetPostInput\Prebuilt\ValidateFloat;

$float = 0.0;
{
    $_float = new ValidateFloat("float"); // The name of the input, so $_GET["float"]
    $errors[] = $_float->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $float = $_float->getValue(); // This returns the value of the input.
}
```

### ValidateText
```php
use ValidateGetPostInput\Prebuilt\ValidateText;

$text = "";
{
    $_text = new ValidateText("text"); // The name of the input, so $_GET["text"]
    $errors[] = $_text->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $text = $_text->getValue(); // This returns the value of the input.
}
```

### ValidateJSON
```php
use ValidateGetPostInput\Prebuilt\ValidateJSON;

$json = [];
{
    $_json = new ValidateJSON("json"); // The name of the input, so $_GET["json"]
    $errors[] = $_json->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $json = $_json->getValue(); // This returns the value of the input.
}
```

### ValidateID
The minimum value of the id is 1, and the maximum value is 2147483647.
```php
use ValidateGetPostInput\Prebuilt\ValidateID;

$id = 0;
{
    $_id = new ValidateID("id"); // The name of the input, so $_GET["id"]
    $errors[] = $_id->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $id = $_id->getValue(); // This returns the value of the input.
}
```

### ValidateEmail
```php
use ValidateGetPostInput\Prebuilt\ValidateEmail;

$email = "";
{
    $_email = new ValidateEmail("email"); // The name of the input, so $_GET["email"]
    $errors[] = $_email->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $email = $_email->getValue(); // This returns the value of the input.
}
```

### ValidateVarchar255
```php
use ValidateGetPostInput\Prebuilt\ValidateVarchar255;

$varchar255 = "";
{
    $_varchar255 = new ValidateVarchar255("varchar255"); // The name of the input, so $_GET["varchar255"]
    $errors[] = $_varchar255->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $varchar255 = $_varchar255->getValue(); // This returns the value of the input.
}
```

### ValidateVarchar255Regex
```php
use ValidateGetPostInput\Prebuilt\ValidateVarchar255Regex;

$varchar255Regex = "";
{
    $_varchar255Regex = new ValidateVarchar255Regex("varchar255Regex", "/^[a-zA-Z0-9]+$/"); // The name of the input, so $_GET["varchar255Regex"]
    $errors[] = $_varchar255Regex->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $varchar255Regex = $_varchar255Regex->getValue(); // This returns the value of the input.
}
```

### ValidateDate
The default date format is 'Y-m-d H:i:s', but you can change it with the fourth parameter.
```php
use ValidateGetPostInput\Prebuilt\ValidateDate;
use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Statics\DateFormat;

$date = "";
{
    $_date = new ValidateDate("date", RequestType::GET, true, DateFormat::YYYY_MM_DD); // The name of the input, so $_GET["date"], the third parameter is if the input is required, default is true. The fourth parameter is the date format, default is 'Y-m-d H:i:s'.
    $errors[] = $_date->validate(); // This returns an array with errors if there are any, returns an empty array if there are no errors.
    $date = $_date->getValue(); // This returns the value of the input.
}
```

## License

This project is licensed under the [MIT](license)
 License - see the [LICENSE](license) file for
details
