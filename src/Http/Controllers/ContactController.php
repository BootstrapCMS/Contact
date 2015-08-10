<?php

/*
 * This file is part of Laravel Contact.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Contact\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\Contact\Facades\Mailer;
use GrahamCampbell\Throttle\Throttlers\ThrottlerInterface;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * This is the contact controller class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
     * The contact form path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new instance.
     *
     * @param \GrahamCampbell\Throttle\Throttlers\ThrottlerInterface $throttler
     * @param string                                                 $path
     *
     * @return void
     */
    public function __construct(ThrottlerInterface $throttler, $path)
    {
        $this->throttler = $throttler;
        $this->path = $path;

        $this->beforeFilter('throttle.contact', ['only' => ['postSubmit']]);
    }

    /**
     * Submit the contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postSubmit()
    {
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'message'    => 'required',
        ];

        $input = Binput::only(array_keys($rules));

        $val = Validator::make($input, $rules);

        if ($val->fails()) {
            return Redirect::to($this->path)->withInput()->withErrors($val);
        }

        $this->throttler->hit();

        Mailer::send($input['first_name'], $input['last_name'], $input['email'], $input['message']);

        return Redirect::to('/')->with('success', 'Your message was sent successfully. Thank you for contacting us.');
    }
}
