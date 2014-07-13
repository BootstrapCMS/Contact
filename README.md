Laravel Contact
===============


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-Contact/master.svg?style=flat)](https://travis-ci.org/GrahamCampbell/Laravel-Contact)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Contact.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Contact/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Contact.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Contact)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg?style=flat)](LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-Contact.svg?style=flat)](https://github.com/GrahamCampbell/Laravel-Contact/releases)


## Introduction

Laravel Contact was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and provides a contact form backend for [Laravel 4.2+](http://laravel.com). It utilises a few of my packages including [Laravel Throttle](https://github.com/GrahamCampbell/Laravel-Throttle) and [Laravel Binput](https://github.com/GrahamCampbell/Laravel-Binput). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Contact/releases), [license](LICENSE.md), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).


## Installation

[PHP](https://php.net) 5.4.7+ or [HHVM](http://hhvm.com) 3.1+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Contact, simply require `"graham-campbell/contact": "~0.2"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

You will need to register a few service providers before you attempt to load the Laravel Contact service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Core\CoreServiceProvider'`
* `'GrahamCampbell\Security\SecurityServiceProvider'`
* `'GrahamCampbell\Binput\BinputServiceProvider'`
* `'GrahamCampbell\Throttle\ThrottleServiceProvider'`

Once Laravel Contact is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Contact\ContactServiceProvider'`


## Configuration

Laravel Contact supports optional configuration.

To get started, first publish the package config file:

    php artisan config:publish graham-campbell/contact

There are two config options:

##### Path To The Form

This option (`'path'`) defines the path to the contact form. This is the page where your contact form should be. The default value for this setting is `'pages/contact'`.

##### Contact Form Email

This option (`'email'`) defines the email address to send contact form messages to. It can be a single address, or an array of email addresses. The default value for this setting is `'admin@example.com'`.


## Usage

Laravel Contact is designed to work with [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS). In order for it to work in any Laravel application, you must ensure that you have [app/config/platform.php](https://github.com/GrahamCampbell/Laravel-Platform/blob/master/app/config/platform.php) and [app/config/views.php](https://github.com/GrahamCampbell/Laravel-Platform/blob/master/app/config/views.php) correctly configured, and you know how to use my [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) package as knowledge of the `app:install` and `app:update ` commands is required.

Laravel Contact provides you with the backend functionality (and email views) to create a comment form. You will need to write your own contact form front end with this plugin, although an example contact form is included (`'graham-campbell/contact::form'`). Laravel Contact will register the route `contact.post` which will accept `POST` requests to the path `contact`.

Feel free to check out the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel CloudFlare.

You may see an example of implementation in [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## License

Apache License

Copyright 2014 Graham Campbell

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
