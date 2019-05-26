<?php

//retrieve visitors and pageview data for the current day and the last seven days
use GoogleAnalytics as Analytics;
use Spatie\Analytics\Period;


echo Analytics::fetchTopBrowsers(Period::days(7));