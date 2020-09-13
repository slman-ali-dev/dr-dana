<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Helpers\CommonHelpers;
use App\Models\PatientForm;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Class PatientsGenderChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PatientsGenderChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $genders = CommonHelpers::getGenders();
        
        $labels = [];
        $counts = [];
        foreach($genders as $gender){
            $labels[] = trans("backpack::common.$gender");
            $counts[] = PatientForm::where('gender',$gender)->count();
        }
        $this->chart->labels($labels);        
        $this->chart->dataset('توزع الأنواع', 'pie', $counts)
                        ->backgroundColor([
                            'rgb(70, 127, 208)',
                            'rgb(77, 189, 116)',
                            'rgb(96, 92, 168)',
                            'rgb(255, 193, 7)',
                        ]);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/patients-gender'));

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
    //     $users_created_today = \App\User::whereDate('created_at', today())->count();

    //     $this->chart->dataset('Users Created', 'bar', [
    //                 $users_created_today,
    //             ])
    //         ->color('rgba(205, 32, 31, 1)')
    //         ->backgroundColor('rgba(205, 32, 31, 0.4)');
    // }
}