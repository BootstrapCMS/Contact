<?php

/*
 * This file is part of Laravel Contact by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Contact;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * This is the contact service provider class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Contact/blob/master/LICENSE.md> Apache 2.0
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

        $this->setupRoutes($this->app['router']);
    }

    /**
     * Setup the routes.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        require __DIR__.'/Http/filters.php';

        $router->group(['namespace' => 'GrahamCampbell\Contact\Http\Controllers'], function (Router $router) {
            require __DIR__.'/Http/routes.php';
        });
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
        $this->app->bind('contact.mailer', function ($app) {
            $mail = $app['mailer'];
            $home = $app['config']['graham-campbell/core::home'];
            $path = $app['config']['graham-campbell/contact::path'];
            $email = $app['config']['graham-campbell/contact::email'];
            $name = $app['config']['graham-campbell/core::name'];

            return new Mailer($mail, $home, $path, $email, $name);
        });

        $this->app->alias('contact.mailer', 'GrahamCampbell\Contact\Mailer');
    }

    /**
     * Register the contact controller class.
     *
     * @return void
     */
    protected function registerContactController()
    {
        $this->app->bind('GrahamCampbell\Contact\Http\Controllers\ContactController', function ($app) {
            $throttler = $app['throttle']->get($app['request'], 2, 30);
            $home = $app['config']['graham-campbell/core::home'];
            $path = $app['config']['graham-campbell/contact::path'];

            return new Http\Controllers\ContactController($throttler, $home, $path);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'contact.mailer',
        ];
    }
}
