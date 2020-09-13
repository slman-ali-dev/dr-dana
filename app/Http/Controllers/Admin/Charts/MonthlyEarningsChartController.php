<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\PatientReview;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use Carbon\Carbon;
// use ConsoleTVs\Charts\Classes\Chartjs\Chart;
// use ConsoleTVs\Charts\Classes\Echarts\Chart;
use ConsoleTVs\Charts\Classes\Fusioncharts\Chart;
// use ConsoleTVs\Charts\Classes\Highcharts\Chart;
// use ConsoleTVs\Charts\Classes\C3\Chart;
// use ConsoleTVs\Charts\Classes\Frappe\Chart;

/**
 * Class MonthlyEarningsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MonthlyEarningsChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        // $this->chart->labels([
        //     'Today',
        // ]);
        
        
        $now = Carbon::now()->firstOfMonth();
        $labels = [];
        $earnings = [];
        for ($i = 0; $i < 12; ++$i) {
            $labels[] = "($now->year / $now->month)";
            $earnings [] = PatientReview::whereMonth('created_at',$now->month)->sum('earn');
            $now->subMonth();
        }
        
        $this->chart->labels(array_reverse($labels));
        $this->chart->dataset("الأرباح", 'line', array_reverse($earnings));

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/monthly-earnings'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    // public function data()
    // {
    //     $now = Carbon::now()->firstOfMonth();
    //     $labels = [];
    //     $earnings = [];
    //     for ($i = 0; $i < 12; ++$i) {
    //         $labels[] = "($now->year / $now->month)";
    //         $earnings [] = PatientReview::whereMonth('created_at',$now->month)->sum('earn');
    //         $now->subMonth();
    //     }
        
    //     $this->chart->labels($labels);
    //     $this->chart->dataset("الأرباح", 'line', $earnings);
    // }
}
