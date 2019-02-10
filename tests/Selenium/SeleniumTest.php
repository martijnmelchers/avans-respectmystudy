<?php

namespace Tests\Selenium;

use Modelizer\Selenium\SeleniumTestCase;

class SeleniumTest extends SeleniumTestCase
{
	/**
	 * We need this because SeleniumTestCase calls the setUpTheTestEnvironmentTraits with no arguments but it requires 1
	 *
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        return $this->setUpTheTestEnvironmentTraits(array());
    }
}