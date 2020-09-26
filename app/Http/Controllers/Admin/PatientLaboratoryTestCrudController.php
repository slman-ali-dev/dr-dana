<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PatientLaboratoryTestRequest;
use App\Models\PatientForm;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PatientLaboratoryTestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PatientLaboratoryTestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PatientLaboratoryTest::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/patientlaboratorytest');
        CRUD::setEntityNameStrings('تحليل مخبري', 'التحاليل المخبرية');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns
        $this->crud->addFilter(
            [
                'name'  => 'patient_form_id',
                'type'  => 'select2',
                'label' => 'فلترة حسب المريض',
                'placeholder' => 'اكتب اسم المريض للفلترة'
            ],
            function () {
                return PatientForm::all()->pluck('patient_with_id', 'id')->toArray();
            },
            function ($value) { // if the filter is active
                $this->crud->addClause('where', 'patient_form_id', $value);
            }
        );

        $this->crud->addColumn(['name' => 'patient_with_id', 'label' => trans('backpack::common.patient_name')]);
        $this->crud->addColumn(['name' => 'sugar', 'label' => trans('backpack::common.sugar')]);
        $this->crud->addColumn(['name' => 'date', 'label' => trans('backpack::common.date')]);
        $this->crud->addColumn(['name' => 'ca', 'label' => trans('backpack::common.ca')]);
        $this->crud->addColumn(['name' => 'total_protein', 'label' => trans('backpack::common.total_protein')]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PatientLaboratoryTestRequest::class);

        CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
