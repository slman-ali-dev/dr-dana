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

        
        $this->crud->removeField('patient_form_id');

        $this->crud->addField([  // Select
            'label'     => "المريض",
            'type'      => 'select2',
            'name'      => 'patient_form_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'Patient',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\PatientForm", // related model
            'attribute' => 'patient_with_id', // foreign key attribute that is shown to user
            'default' => '',

            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                return $query->orderBy('updated_at', 'DESC')->get();
            }), //  you can use this to filter the results show in the select
        ]);

        $this->crud->addField(
            [   // DateTime
                'name' => 'date',
                'label' => 'تاريخ التحليل',
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'en'
                ],
                'allows_null' => true,
                // 'default' => '2017-05-12 11:59:59',
            ],
        );
        

        $this->crud->addField(['name' => 'date', 'label' => trans('backpack::common.date'), "type" => "datetime"]);
        $this->crud->addField(['name' => 'sugar', 'label' => trans('backpack::common.sugar'), "type" => "text" ]);
        $this->crud->addField(['name' => 'pigment', 'label' => trans('backpack::common.pigment'), "type" => "text" ]);
        $this->crud->addField(['name' => 'cholesterol', 'label' => trans('backpack::common.cholesterol'), "type" => "text" ]);
        $this->crud->addField(['name' => 'triple_lipids', 'label' => trans('backpack::common.triple_lipids'), "type" => "text" ]);
        $this->crud->addField(['name' => 'ca', 'label' => trans('backpack::common.ca'), "type" => "text" ]);
        $this->crud->addField(['name' => 'na', 'label' => trans('backpack::common.na'), "type" => "text" ]);
        $this->crud->addField(['name' => 'k', 'label' => trans('k'), "type" => "text" ]);
        $this->crud->addField(['name' => 'total_protein', 'label' => trans('backpack::common.total_protein'), "type" => "text" ]);

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


    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-Show
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->addColumn(['name' => 'patient_form_id', 'label' => trans('backpack::common.id')]);
        $this->crud->addColumn(['name' => 'patient_name', 'label' => trans('backpack::common.patient_name')]);

        $this->crud->addColumn(['name' => 'date', 'label' => trans('backpack::common.date'), "type" => "datetime"]);
        $this->crud->addColumn(['name' => 'sugar', 'label' => trans('backpack::common.sugar')]);
        $this->crud->addColumn(['name' => 'pigment', 'label' => trans('backpack::common.pigment')]);
        $this->crud->addColumn(['name' => 'cholesterol', 'label' => trans('backpack::common.cholesterol')]);
        $this->crud->addColumn(['name' => 'triple_lipids', 'label' => trans('backpack::common.triple_lipids')]);
        $this->crud->addColumn(['name' => 'ca', 'label' => trans('backpack::common.ca')]);
        $this->crud->addColumn(['name' => 'na', 'label' => trans('backpack::common.na')]);
        $this->crud->addColumn(['name' => 'k', 'label' => trans('k')]);
        $this->crud->addColumn(['name' => 'total_protein', 'label' => trans('backpack::common.total_protein')]);

    }

}
