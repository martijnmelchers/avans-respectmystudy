<?php

namespace Tests\Selenium;
use App\Minor;
use Tests\SeleniumTest;


class ReviewTest extends SeleniumTest
{

    public function testInsertReview()
    {
        $this->visit('minor')
            ->type('Test review', 'title')
            ->type('Test review message', 'message')
            ->check('star4_1')->check('star5_2')->check('star4_3')
            ->press('submitbutton');
    }

    public function testInsertReviewForNullValues()
    {
        $this->visit('minor')
            ->type('Test review', 'title')
            ->type('Test review message', 'message')
            ->press('submitbutton');
    }

    public function testShowReview()
    {
        $review = factory(App\Review::class)->create();
        $this->visit('minor', $review->minor_id)
            ->see('Title for test minor');
    }

    public function testMergeReviews()
    {
        $this->visit('dashboard-merge')
            ->type('Test merge review', 'title')
            ->type('Test merge review message', 'message')
            ->check('star4_1')->check('star5_2')->check('star4_3')
            ->press('submitbutton');
    }

    public function testMergeReviewsForNullValues()
    {
        $this->visit('minor')
            ->type('Test merge review', 'title')
            ->type('Test merge review message', 'message')
            ->press('submitbutton');
    }
}
