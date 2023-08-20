# Application with Laminas MVC framework

## Introduction

This is a application using the Laminas MVC framework and Laminas components. 
This application is meant to be used as a starting place for the own web application.

## Installation using GitHub and Composer

The easiest way to create a new application for de_DE with Laminas MVC is 
to use this Repository on GitHub
https://github.com/nik-web/application.git 
and [Composer](https://getcomposer.org/).

### To create your new application
Folder to clone into:

```bash
$ mkdir /home/<username>/www/html/
$ cd /home/<username>/www/html/
$ git clone https://github.com/nik-web/application.git
```
This will download the project to a folder named after the Git repository ("application" in this case).
If you want a different folder name, simply specify it as the last parameter:

```bash
$ git clone https://github.com/nik-web/application.git other-name
```
Composer install:

```bash
$ cd path/to/install
$ composer install
```
Change the rights for the following directory:

```bash
cd /home/<username>/www/html/<application-root>/
# chown -R www-data:www-data data
$ chmod -R 775 data
```
Add your provider data to the web application:
Copy the file without the .dist extension and change the values of the constants.

```bash
$ cd path/to/install
$ cp module/Application/src/ValueObject/Provider.php.dist module/Application/src/ValueObject/Provider.php
```

Once installed, you can test it out immediately using PHP's built-in web server:

```bash
$ cd path/to/install
$ php -S 0.0.0.0:8080 -t public
```
This will start the cli-server on port 8080, and bind it to all network
interfaces. You can then visit the site at:

http://localhost:8080/

**Note:** The built-in CLI server is *for development only*.

## Installation add the provider data

```bash
    $ cd path/to/install
    $ cp application/module/Application/src/ValueObject/Provider.php.dist application/module/Application/src/ValueObject/Provider.php
```
Enter your data into the constants in this file.

## Use development mode

```bash
$ ./vendor/bin/laminas-development-mode enable  # enable development mode
$ ./vendor/bin/laminas-development-mode disable # disable development mode
```

## Running Unit Tests

To run the unit tests, you need to do one of the following:

- Install the MVC test support with [laminas-test](https://docs.laminas.dev/laminas-test/)

```bash
$ cd path/to/install
$ composer require --dev laminas/laminas-test
```

Once testing support is present, you can run the tests using:

```bash
$ cd path/to/install
$ ./vendor/bin/phpunit
```