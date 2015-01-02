<?php

/*
 * This file is part of Laravel Contact.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::post('contact', [
    'as'   => 'contact.post',
    'uses' => 'GrahamCampbell\Contact\Controllers\ContactController@postSubmit',
]);
