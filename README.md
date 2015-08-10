Laravel Contact
===============

Laravel Contact was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and provides a contact form backend for [Laravel 5](http://laravel.com). It utilises a few of my packages including [Laravel Throttle](https://github.com/GrahamCampbell/Laravel-Throttle) and [Laravel Binput](https://github.com/GrahamCampbell/Laravel-Binput). Feel free to check out the [releases](https://github.com/BootstrapCMS/Contact/releases), [license](LICENSE), and [contribution guidelines](CONTRIBUTING.md).

![Laravel Contact](https://cloud.githubusercontent.com/assets/2829600/4432323/c18fe95c-468c-11e4-940d-c41718dfbb73.PNG)

<p align="center">
<a href="https://travis-ci.org/BootstrapCMS/Contact"><img src="https://img.shields.io/travis/BootstrapCMS/Contact/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BootstrapCMS/Contact/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/BootstrapCMS/Contact.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BootstrapCMS/Contact"><img src="https://img.shields.io/scrutinizer/g/BootstrapCMS/Contact.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/BootstrapCMS/Contact/releases"><img src="https://img.shields.io/github/release/BootstrapCMS/Contact.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Contact, simply add the following line to the require block of your `composer.json` file:

```
"graham-campbell/contact": "~1.0"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

You will need to register a few service providers before you attempt to load the Laravel Contact service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Security\SecurityServiceProvider'`
* `'GrahamCampbell\Binput\BinputServiceProvider'`
* `'GrahamCampbell\Throttle\ThrottleServiceProvider'`

Once Laravel Contact is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Contact\ContactServiceProvider'`


## Configuration

Laravel Contact supports optional configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/contact.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are a few config options:

##### Path To The Form

This option (`'path'`) defines the path to the contact form. This is the page where your contact form should be. The default value for this setting is `'pages/contact'`.

##### Contact Form Email

This option (`'email'`) defines the email address to send contact form messages to. It can be a single address, or an array of email addresses. The default value for this setting is `'admin@example.com'`.

##### Email Layout

This option (`'layout'`) defines the layout to extend when building email views. The default value for this setting is `'layouts.email'`.

##### Additional Configuration

You will need to add a `'name'` key to your app config to set the application name.


## Usage

Laravel Contact is designed to work with [Bootstrap CMS](https://github.com/BootstrapCMS/CMS). In order for it to work in any Laravel application, you must ensure that you know how to use my [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) package as configuration and knowledge of the `app:install` and `app:update ` commands is required.

Laravel Contact provides you with the backend functionality (and email views) to create a comment form. You will need to write your own contact form front end with this plugin, although an example contact form is included (`'contact.form'`). Laravel Contact will register the route `contact.post` which will accept `POST` requests to the path `contact`.


## License

Laravel Contact is licensed under [The MIT License (MIT)](LICENSE).
