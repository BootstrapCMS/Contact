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

use Illuminate\Mail\Mailer as Mail;

/**
 * This is the contact mailer class.
 *
 * @package    Laravel-Contact
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Contact/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Contact
 */
class Mailer
{
    /**
     * The mail instance.
     *
     * @var \Illuminate\Mail\Mailer
     */
    protected $mail;

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
     * The platform name.
     *
     * @var string
     */
    protected $name;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Mail\Mailer  $mail
     * @param  string  $home
     * @param  string  $path
     * @param  string  $name
     * @return void
     */
    public function __construct(Mail $mail, $home, $path, $name)
    {
        $this->mail = $mail;
        $this->home = $home;
        $this->path = $path;
        $this->name = $name;
    }

    /**
     * Send the emails.
     *
     * @param  string  $first
     * @param  string  $last
     * @param  string  $email
     * @param  string  $message
     * @return void
     */
    public function send($first, $last, $email, $message)
    {
        $quote = nl2br($message);

        $name = $first . ' ' . $last;

        $this->sendMessage($name, $email, $quote);

        $this->sendThanks($first, $email, $quote);
    }

    /**
     * Send the message.
     *
     * @param  string  $name
     * @param  string  $email
     * @param  string  $quote
     * @return void
     */
    protected function sendMessage($name, $email, $quote)
    {
        $mail = array(
            'email'   => $this->email,
            'subject' => $this->name.' - New Message',
            'url'     => $this->home,
            'contact' => $email,
            'name'    => $name,
            'quote'   => $quote
        );

        $this->mail->queue('graham-campbell/contact::message', $mail, function($message) use ($mail) {
            $message->to($mail['email'])->subject($mail['subject']);
        });
    }

    /**
     * Sent the thanks message.
     *
     * @param  string  $name
     * @param  string  $email
     * @param  string  $quote
     * @return void
     */
    protected function sendThanks($name, $email, $quote)
    {
        $mail = array(
            'email'   => $email,
            'subject' => $this->name.' - Notification',
            'url'     => $this->home,
            'name'    => $name,
            'quote'   => $quote
        );

        $this->mail->queue('graham-campbell/contact::thanks', $mail, function($message) use ($mail) {
            $message->to($mail['email'])->subject($mail['subject']);
        });
    }

    /**
     * Return the mail instance.
     *
     * @return \Illuminate\Mail\Mailer
     */
    public function getMail()
    {
        return $this->mail;
    }
}
