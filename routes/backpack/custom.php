<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/calendar', 'CalendarController@index');
    Route::crud('patientform', 'PatientFormCrudController');
    Route::get('patientreview/ajax-patients-options', 'PatientReviewCrudController@patientOptions');
    Route::crud('patientreview', 'PatientReviewCrudController');
    Route::crud('patientlaboratorytest', 'PatientLaboratoryTestCrudController');
    Route::get('charts/monthly-patients', 'Charts\MonthlyPatientsChartController@response')->name('charts.monthly-patients.index');
    Route::get('charts/monthly-earnings', 'Charts\MonthlyEarningsChartController@response')->name('charts.monthly-earnings.index');
    Route::get('charts/patients-gender', 'Charts\PatientsGenderChartController@response')->name('charts.patients-gender.index');
}); // this should be the absolute last line of this file
