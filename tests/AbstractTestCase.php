<?php

/*
 * This file is part of Laravel Contact.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Contact;

use GrahamCampbell\TestBench\AbstractLaravelTestCase;

/**
 * This is the abstract test case class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
abstract class AbstractTestCase extends AbstractLaravelTestCase
{
    /**
     * Get the required service providers.
     *
     * @return string[]
     */
    protected function getRequiredServiceProviders()
    {
        return [
            'GrahamCampbell\Core\CoreServiceProvider',
            'GrahamCampbell\Security\SecurityServiceProvider',
            'GrahamCampbell\Binput\BinputServiceProvider',
            'GrahamCampbell\Throttle\ThrottleServiceProvider',
        ];
    }

    /**
     * Get the service provider class.
     *
     * @return string
     */
    protected function getServiceProviderClass()
    {
        return 'GrahamCampbell\Contact\ContactServiceProvider';
    }
}
