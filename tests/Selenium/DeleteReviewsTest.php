<?php

namespace Tests\Selenium;
use Tests\SeleniumTest;

class DeleteReviewsTest extends SeleniumTest
{
    public function testInsertReview()
    {
        $inputs = [
            "title" => "Test title",
            "message" => "Test message",
            "rating_1" => "3",
            "rating_2" => "4",
            "rating_3" => "5"
        ];

        $this->visit('/minor/137248')
            ->submitForm($inputs, '#add-review-form')
            ->see('Uw review is geplaatst!')
            ->hold(3);
    }

    public function testDeleteReview()
    {
        $this->visit('/minor/137248')
             ->see('RespectMyStudy')
             ->hold(3);
    }
}