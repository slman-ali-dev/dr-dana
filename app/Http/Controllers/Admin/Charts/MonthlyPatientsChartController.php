<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Helpers\CommonHelpers;
use App\Models\PatientForm;
use App\Models\PatientReview;
use App\User;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use Carbon\Carbon;
// use ConsoleTVs\Charts\Classes\Chartjs\Chart;
// use ConsoleTVs\Charts\Classes\Echarts\Chart;
// use ConsoleTVs\Charts\Classes\Fusioncharts\Chart;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;
// use ConsoleTVs\Charts\Classes\C3\Chart;
// use ConsoleTVs\Charts\Classes\Frappe\Chart;

/**
 * Class MonthlyPatientsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MonthlyPatientsChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();


        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/monthly-patients'));
        $this->chart->labels( CommonHelpers::getArabicMonthsArray() );

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {
        $patients = [];
        
        for ($month = 1; $month <= 12; ++$month) {
            $patients[] = PatientReview::whereMonth('created_at',$month)->count();
        }

        $this->chart->dataset("المراجعات", 'line',$patients);
    }
}
