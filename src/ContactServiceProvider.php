<?php

/**
 * This file is part of Laravel Contact by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Contact;

use Illuminate\Support\ServiceProvider;

/**
 * This is the contact service provider class.
 *
 * @package    Laravel-Contact
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Contact/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Contact
 */
class ContactServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('graham-campbell/contact', 'graham-campbell/contact', __DIR__);

        include __DIR__.'/routes.php';
        include __DIR__.'/filters.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerContactMailer();
        $this->registerContactController();
    }

    /**
     * Register the contact mailer class.
     *
     * @return void
     */
    protected function registerContactMailer()
    {
        $this->app->bind('GrahamCampbell\Contact\Mailer', function ($app) {
            $mail = $app['mailer'];
            $home = $app['config']['graham-campbell/core::home'];
            $path = $app['config']['graham-campbell/contact::path'];
            $email = $app['config']['graham-campbell/contact::email'];
            $name = $app['config']['platform.name'];

            return new Mailer($mail, $home, $path, $email, $name);
        });
    }

    /**
     * Register the contact controller class.
     *
     * @return void
     */
    protected function registerContactController()
    {
        $this->app->bind('GrahamCampbell\Contact\Controllers\ContactController', function ($app) {
            $mailer = $app->make('GrahamCampbell\Contact\Mailer');
            $binput = $app['binput'];
            $home = $app['config']['graham-campbell/core::home'];
            $path = $app['config']['graham-campbell/contact::path'];

            return new Controllers\ContactController($mailer, $binput, $home, $path);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            //
        );
    }
}
