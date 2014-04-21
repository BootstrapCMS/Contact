Laravel Contact
===============


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-Contact/master.svg)](https://travis-ci.org/GrahamCampbell/Laravel-Contact)
[![Coverage Status](https://img.shields.io/coveralls/GrahamCampbell/Laravel-Contact/master.svg)](https://coveralls.io/r/GrahamCampbell/Laravel-Contact)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg)](https://github.com/GrahamCampbell/Laravel-Contact/blob/master/LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-Contact.svg)](https://github.com/GrahamCampbell/Laravel-Contact/releases)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Contact/badges/quality-score.png?s=e6a3e1e0e7c144da9d5f0324b45bed135579f6fe)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Contact)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/8d54e859-7c8e-47e0-aced-11b84f3cca3e/mini.png)](https://insight.sensiolabs.com/projects/8d54e859-7c8e-47e0-aced-11b84f3cca3e)


## What Is Laravel Contact?

Laravel Contact is a contact form backend for [Laravel 4.1](http://laravel.com).

* Laravel Contact was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).
* Laravel Contact relies on a few of my packages including [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) and [Laravel Queuing](https://github.com/GrahamCampbell/Laravel-Queuing).
* Laravel Contact uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-Contact) with [Coveralls](https://coveralls.io/r/GrahamCampbell/Laravel-Contact) to check everything is working.
* Laravel Contact uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Contact) and [SensioLabsInsight](https://insight.sensiolabs.com/projects/8d54e859-7c8e-47e0-aced-11b84f3cca3e) to run additional checks.
* Laravel Contact uses [Composer](https://getcomposer.org) to load and manage dependencies.
* Laravel Contact provides a [change log](https://github.com/GrahamCampbell/Laravel-Contact/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Contact/releases), and [api docs](http://grahamcampbell.github.io/Laravel-Contact).
* Laravel Contact is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/Laravel-Contact/blob/master/LICENSE.md).


## System Requirements

* PHP 5.4.7+ or HHVM 3.0+ is required.
* You will need [Laravel 4.1](http://laravel.com) because this package is designed for it.
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel Contact.


## Installation

Please check the system requirements before installing Laravel Contact.

To get the latest version of Laravel Contact, simply require `"graham-campbell/contact": "0.1.*@alpha"` in your `composer.json` file. See the [Laravel Queuing](https://github.com/GrahamCampbell/Laravel-Queuing) readme for extra requirements before continuing. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

You will need to register a few service providers before you attempt to load the Laravel Contact service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Core\CoreServiceProvider'`
* `'GrahamCampbell\Queuing\QueuingServiceProvider'`
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

**Path To The Form**

This option (`'path'`) defines the path to the contact form. This is the page where your contact form should be. The default value for this setting is `'pages/contact'`.

**Contact Form Email**

This option (`'email'`) defines the email address to send contact form messages to. It can be a single address, or an array of email addresses. The default value for this setting is `null`.


## Usage

There is currently no usage documentation besides the [API Documentation](http://grahamcampbell.github.io/Laravel-Contact
) for Laravel Contact.

You will need to write your own contact form with this plugin. Laravel Contact simply provides you with the backend functionality to create a comment form. Laravel Contact will register the route `contact.post` which will accept `POST` requests to the path `contact`. Note that a basic form is included and can be pulled into one of your own views if you want it.

You may see an example of implementation in [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## Updating Your Fork

Before submitting a pull request, you should ensure that your fork is up to date.

You may fork Laravel Contact:

    git remote add upstream git://github.com/GrahamCampbell/Laravel-Contact.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).

You can then update the branch:

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.


## Pull Requests

Please review these guidelines before submitting any pull requests.

* When submitting bug fixes, check if a maintenance branch exists for an older series, then pull against that older branch if the bug is present in it.
* Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title.
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).


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
