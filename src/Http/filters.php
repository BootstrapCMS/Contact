<?php

/*
 * This file is part of Laravel Contact.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

$router->filter('throttle.contact', function ($route, $request) {
    // check if we've reached the rate limit, but don't hit the throttle yet
    // we can hit the throttle later on in the if validation passes
    if (!Throttle::check($request, 2, 30)) {
        Session::flash('error', 'You have made too many submissions recently. Please try again later.');

        return Redirect::to(Config::get('contact.path'))->withInput();
    }
});
