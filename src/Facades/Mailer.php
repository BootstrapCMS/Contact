<?php

/*
 * This file is part of Laravel Contact.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Contact\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the mailer facade class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Mailer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'contact.mailer';
    }
}
