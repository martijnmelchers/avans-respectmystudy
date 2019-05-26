<?php

namespace Tests\Selenium;
use Tests\SeleniumTest;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class SeleniumUserTest extends SeleniumTest
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testRegister()
    {
        // User that is going to be registered.
        $registerInput = [
            'name' => 'Joep',
            'email' => 'joep@haaksma.me',
            'password' => 'joeppiejajee',
            'password-confirm' => 'joeppiejajee',
        ];

        // Does register work?
        $this->visit('/register')
             ->submitForm($registerInput, '#registerForm')
             ->see('Welkom');
    }

    /**
     * Test the logins of the user.
     */
    public function testLogin(){

        $loginInput = [
            "email" => 'joep@haaksma.me',
            "password" => 'joeppiejajee'
        ];

        $this->visit('/login')
        ->submitForm($loginInput, "#loginForm")
        ->see('Welkom');
    }


    public function testLogout(){
        $loginInput = [
            "email" => 'joep@haaksma.me',
            "password" => 'joeppiejajee'
        ];

        $this->visit('/login')
        ->submitForm($loginInput, "#loginForm")
        ->click('Logout')
        ->seePageIs('/');
    }
}