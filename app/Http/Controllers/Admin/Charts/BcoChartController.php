<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\PatientForm;
use App\Models\PatientReview;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Class BcoChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BcoChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        $all = PatientForm::all()->count();
        $yes = PatientForm::where('bco', 'يوجد')->count();

        $labels = [
            "نعم",
            "لا",
        ];
        $counts = [
            $yes,
            $all - $yes
        ];

        $this->chart->labels($labels);
        $this->chart->dataset('مرضى الBCO', 'pie', $counts)
            ->backgroundColor([
                'rgb(70, 127, 208)',
                'rgb(77, 189, 116)',
                'rgb(96, 92, 168)',
                'rgb(255, 193, 7)',
            ]);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/patients-diabetes'));

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
