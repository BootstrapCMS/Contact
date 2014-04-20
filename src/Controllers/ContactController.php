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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\HTMLMin\Facades\HTMLMin;
use GrahamCampbell\Queuing\Facades\Queuing;

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
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->beforeFilter('throttle.contact', array('only' => array('postSubmit')));
    }

    /**
     * Submit the contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postSubmit()
    {
        $input = Binput::only(array('first_name', 'last_name', 'email', 'message'));

        $rules = array(
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'message'    => 'required'
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::to(Config::get('graham-campbell/contact::path'))->withInput()->withErrors($val);
        }

        $url = URL::to(Config::get('graham-campbell/core::home', '/'));

        $quote = HTMLMin::render(nl2br(e($input['message'])));

        try {
            $data = array(
                'view'    => 'graham-campbell/cms-contact::message',
                'email'   => Config::get('graham-campbell/contact::email'),
                'subject' => Config::get('platform.name').' - New Message',
                'url'     => $url,
                'contact' => $input['email'],
                'name'    => $input['first_name'].' '.$input['last_name'],
                'quote'   => $quote
            );

            Queuing::pushMail($data);

            $data = array(
                'view'    => 'graham-campbell/contact::thanks',
                'email'   => $input['email'],
                'subject' => Config::get('platform.name').' - Notification',
                'url'     => $url,
                'name'    => $input['first_name'],
                'quote'   => $quote
            );

            Queuing::pushMail($data);
        } catch (\Exception $e) {
            return Redirect::to(Config::get('graham-campbell/contact::path'))->withInput()
                ->with('error', 'We were unable to send the message. Please contact support.');
        }

        return Redirect::to(Config::get('graham-campbell/core::home', '/'))
            ->with('success', 'Your message was sent successfully. Thank you for contacting us.');
    }
}
