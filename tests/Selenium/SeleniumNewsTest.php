<?php

namespace Tests\Selenium;
use Tests\SeleniumTest;

class SeleniumNewsTest extends SeleniumTest
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDashboardGet()
    {
        $this->visit('/dashboard/news')
        ->see('Nieuws');
    }
}
