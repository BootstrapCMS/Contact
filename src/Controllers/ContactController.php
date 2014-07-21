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

namespace GrahamCampbell\Contact\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use GrahamCampbell\Facades\Binput\Binput;
use GrahamCampbell\Contact\Facades\Mailer;
use GrahamCampbell\Throttle\Throttlers\ThrottlerInterface;

/**
 * This is the contact controller class.
 *
 * @package    Laravel-Contact
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Contact/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Contact
 */
class ContactController extends Controller
{
    /**
     * The throttler instance.
     *
     * @var \GrahamCampbell\Throttle\Throttlers\ThrottlerInterface
     */
    protected $throttler;

    /**
     * The home url.
     *
     * @var string
     */
    protected $home;

    /**
     * The contact form path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Throttle\Throttlers\ThrottlerInterface  $throttler
     * @param  string  $home
     * @param  string  $path
     * @return void
     */
    public function __construct(ThrottlerInterface $throttler, $home, $path)
    {
        $this->throttler = $throttler;
        $this->home = $home;
        $this->path = $path;

        $this->beforeFilter('throttle.contact', array('only' => array('postSubmit')));
    }

    /**
     * Submit the contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postSubmit()
    {
        $rules = array(
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'message'    => 'required'
        );

        $input = Binput::only(array_keys($rules));

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::to($this->path)->withInput()->withErrors($val);
        }

        $this->throttler->hit();

        Mailer::send($input['first_name'], $input['last_name'], $input['email'], $input['message']);

        return Redirect::to($this->home)
            ->with('success', 'Your message was sent successfully. Thank you for contacting us.');
    }
}
