<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientForm;
use App\Models\PatientReview;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index()
    {
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];

        $this->data['widgets']['before_content'][] = [
            'type' => 'div',
            'class' => 'row',
            'content' => [
                [
                    'type'        => 'progress_white',
                    'class'       => 'card mb-2',
                    'value'       => PatientForm::all()->count(),
                    'description' => 'استمارات المرضى',
                    'progress'    => 57, // integer
                    'progressClass' => 'progress-bar bg-primary',
                    'wrapper' => ['class' => 'col-sm-12 col-md-4'],
                ],
                [
                    'type'        => 'progress_white',
                    'class'       => 'card mb-2',
                    'value'       => PatientReview::all()->count(),
                    'description' => 'عدد المراجعات الكلية',
                    'progress'    => 89, // integer
                    'progressClass' => 'progress-bar bg-warning',
                    'wrapper' => ['class' => 'col-sm-12 col-md-4'],
                ],
                [
                    'type'        => 'progress_white',
                    'class'       => 'card mb-2',
                    'value'       => PatientReview::sum('earn') . " ل.س ",
                    'description' => 'الدخل الكلي',
                    'progress'    => 75, // integer
                    'progressClass' => 'progress-bar bg-success',
                    'wrapper' => ['class' => 'col-sm-12 col-md-4'],
                ],
            ]
        ];


        $this->data['widgets']['before_content'][] = [
            'type'       => 'chart',
            'controller' => \App\Http\Controllers\Admin\Charts\MonthlyPatientsChartController::class,
            // OPTIONALS

            'class'   => 'card mb-2',
            'wrapper' => ['class' => 'col-md-12'],
            'content' => [
                'header' => 'عدد المراجعات لهذه السنة',
                'body'   => '',
            ],
        ];

        $this->data['widgets']['before_content'][] = [
            'type'       => 'chart',
            'controller' => \App\Http\Controllers\Admin\Charts\MonthlyEarningsChartController::class,
            // OPTIONALS

            'class'   => 'card mb-2',
            'wrapper' => ['class' => 'col-md-12'],
            'content' => [
                'header' => 'الأرباح أخر 12 شهر',
                'body'   => '',
            ],
        ];


        $this->data['widgets']['before_content'][] = [
            'type' => 'div',
            'class' => 'row',
            'content' => [
                [
                    'type'       => 'chart',
                    'controller' => \App\Http\Controllers\Admin\Charts\DiabetesChartController::class,
                    // OPTIONALS

                    'class'   => 'card mb-2',
                    'wrapper' => ['class' => 'col-md-4'],
                    'content' => [
                        'header' => 'مرضى السكري',
                        'body'   => '',
                    ],
                ],
                [
                    'type'       => 'chart',
                    'controller' => \App\Http\Controllers\Admin\Charts\BcoChartController::class,
                    // OPTIONALS

                    'class'   => 'card mb-2',
                    'wrapper' => ['class' => 'col-md-4'],
                    'content' => [
                        'header' => 'مرضى BCO',
                        'body'   => '',
                    ],
                ],
                [
                    'type'       => 'chart',
                    'controller' => \App\Http\Controllers\Admin\Charts\PatientsGenderChartController::class,
                    // OPTIONALS

                    'class'   => 'card mb-2',
                    'wrapper' => ['class' => 'col-md-4'],
                    'content' => [
                        'header' => 'جنس المراجعين',
                        'body'   => '',
                    ],
                ]
            ]
        ];
        return view(backpack_view('dashboard'), $this->data);
    }
}
