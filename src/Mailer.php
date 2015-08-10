<?php

/*
 * This file is part of Laravel Contact.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Contact;

use Illuminate\Contracts\Mail\MailQueue;

/**
 * This is the contact mailer class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Mailer
{
    /**
     * The mail instance.
     *
     * @var \Illuminate\Contracts\Mail\MailQueue
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
     * The contact email.
     *
     * @var string
     */
    protected $email;

    /**
     * The platform name.
     *
     * @var string
     */
    protected $name;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Contracts\Mail\MailQueue $mail
     * @param string                               $home
     * @param string                               $path
     * @param string                               $email
     * @param string                               $name
     *
     * @return void
     */
    public function __construct(MailQueue $mail, $home, $path, $email, $name)
    {
        $this->mail = $mail;
        $this->home = $home;
        $this->path = $path;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Send the emails.
     *
     * @param string $first
     * @param string $last
     * @param string $email
     * @param string $message
     *
     * @return void
     */
    public function send($first, $last, $email, $message)
    {
        $quote = nl2br($message);

        $name = $first.' '.$last;

        $this->sendMessage($name, $email, $quote);

        $this->sendThanks($first, $email, $quote);
    }

    /**
     * Send the message.
     *
     * @param string $name
     * @param string $email
     * @param string $quote
     *
     * @return void
     */
    protected function sendMessage($name, $email, $quote)
    {
        $mail = [
            'email'    => $this->email,
            'subject'  => $this->name.' - New Message',
            'platform' => $this->name,
            'url'      => $this->home,
            'contact'  => $email,
            'name'     => $name,
            'quote'    => $quote,
        ];

        $this->mail->queue('contact::message', $mail, function ($message) use ($mail) {
            $message->to($mail['email'])->subject($mail['subject']);
        });
    }

    /**
     * Sent the thanks message.
     *
     * @param string $name
     * @param string $email
     * @param string $quote
     *
     * @return void
     */
    protected function sendThanks($name, $email, $quote)
    {
        $mail = [
            'email'    => $email,
            'subject'  => $this->name.' - Notification',
            'platform' => $this->name,
            'url'      => $this->home,
            'name'     => $name,
            'quote'    => $quote,
        ];

        $this->mail->queue('contact::thanks', $mail, function ($message) use ($mail) {
            $message->to($mail['email'])->subject($mail['subject']);
        });
    }

    /**
     * Return the mail instance.
     *
     * @return \Illuminate\Contracts\Mail\MailQueue
     */
    public function getMail()
    {
        return $this->mail;
    }
}
