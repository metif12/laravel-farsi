# laravel-farsi

laravel farsi tool package

## Requirement

* Laravel 6, 7, 8
* PHP 7.2 >=

## Install

Via Composer

``` bash
composer require metif12/laravel-farsi
```

## Usage

### Helpers

* farsi_num

convert latin and arabic numbers of given text to farsi numbers

```php
echo farsi_num('123') \\ Output: ۱۲۳
```

* en_num

convert farsi and arabic numbers of given text to latin numbers

```php
echo farsi_num('۱۲۳') \\ Output: 123
```

* farsi

convert specified characters defined in config file by fixing rule

### Request macros

* farsi

convert result of Request::input($name,$default = null) by farsi helper

```php
Request::farsi($name,$default = null)
```

* oldFarsi

convert result of Request::old($name,$default = null) by farsi helper

```php
Request::oldFarsi($name,$default = null)
```

* postFarsi

convert result of Request::post($name,$default = null) by farsi helper

```php
Request::postFarsi($name,$default = null)
```

* queryFarsi

convert result of Request::query($name,$default = null) by farsi helper

```php
Request::queryFarsi($name,$default = null)
```

### Validator::extention

* farsi_letters

persian letters are allowed


* farsi_numbers

persian numbers are allowed


* farsi

persian letters and numbers are allowed

* not_farsi

persian letters and numbers are not allowed

### Model attributes cast

call specified hellper on atribute befor saving

```php
class SomModel extends Model {
   
   protected $farsiAttributes = ['name'=>'farsi'];
}
