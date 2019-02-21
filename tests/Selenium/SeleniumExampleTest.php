<?php

namespace Tests\Selenium;

class SeleniumExampleTest extends SeleniumTest
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // This is a sample code you can change as per your current scenario
        $this->visit('/')
             ->see('NEWS')
             ->hold(3);
    }
}