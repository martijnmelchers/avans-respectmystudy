<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use App\ContactPerson;
use App\Location;
use App\Minor;
use App\Organisation;
use GoogleAnalytics as Analytics;
use Lava;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function Home()
    {
        $stocksTable = Lava::DataTable();  // Lava::DataTable() if using Laravel

        $stocksTable->addDateColumn('Dag')
            ->addNumberColumn('Aantal bezoeken');

        // Get visitor info of last 2 months
        $last_month_results = Analytics::fetchTotalVisitorsAndPageViews(Period::months(2));

        // Put data in graph
        foreach ($last_month_results as $result) {
            $stocksTable->addRow([
                date("Y-m-d", strtotime($result['date'])), $result['visitors']
            ]);
        }

        $chart = Lava::LineChart('Testchart', $stocksTable, [
            'min' => 0
        ]);

        return view('dashboard/dashboard', [
            'minor_amount' => Minor::count(),
            'location_amount' => Location::count(),
            'organisation_amount' => Organisation::count(),
            'contactpersons_amount' => ContactPerson::count(),
            'contactgroups_amount' => ContactGroup::count(),
        ]);
    }

    // KPI's (DELETE ME)
    //Het aantal studenten dat een minor selecteert per jaar
    //Het aantal minors dat elk jaar aan de site wordt toegevoegd
    //De lengte van het gemiddelde websitebezoek
    //Het aantal studenten dat een account aanmaakt per kwartaal
}
