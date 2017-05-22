Yii 2 Seo Module
============================

Yii 2 Seo Module is module for administrating SEO meta tags in the Yii2 application


INSTALLATION
------------

The preferred way to install this extension is through composer.

Either run

~~~
php composer.phar require --prefer-dist rusmd89/yii2-seo-module
~~~

or add

~~~
"rusmd89/yii2-seo-module": "~1.0.0"
~~~

to the require section of your composer.json.


CONFIGURATION
------------

To use this extension, create your parameter file with extension .php with following code

~~~
<?php

return [
    'example' => \rusmd89\seo\tests\classes\ExampleParameter::class,
];
~~~

