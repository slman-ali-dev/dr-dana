<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PatientReviewRequest;
use App\Models\PatientForm;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class PatientReviewCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PatientReviewCrudController extends CrudController
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
        CRUD::setModel(\App\Models\PatientReview::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/patientreview');
        CRUD::setEntityNameStrings('مراجعة مريض', 'مراجعات المرضى');
        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
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
        $this->crud->addColumn(['name' => 'earn', 'label' => trans('backpack::common.earn')]);
        $this->crud->addColumn(['name' => 'date', 'label' => trans('backpack::common.review_date')]);
        $this->crud->addColumn(['name' => 'current_weight', 'label' => trans('backpack::common.current_weight')]);
        // $this->crud->addColumn(['name' => 'fat_percentage', 'label' => trans('backpack::common.fat_percentage')]);
        // $this->crud->addColumn(['name' => 'fluid_ratio', 'label' => trans('backpack::common.fluid_ratio')]);
        // $this->crud->addColumn(['name' => 'muscle_ratio', 'label' => trans('backpack::common.muscle_ratio')]);
        // $this->crud->addColumn(['name' => 'physical_activity', 'label' => trans('backpack::common.physical_activity')]);
        // $this->crud->addColumn(['name' => 'bone_mass', 'label' => trans('backpack::common.bone_mass')]);
        // $this->crud->addColumn(['name' => 'age_of_the_burn', 'label' => trans('backpack::common.age_of_the_burn')]);
        // $this->crud->addColumn(['name' => 'the_degree_of_obesity', 'label' => trans('backpack::common.the_degree_of_obesity')]);
        // $this->crud->addColumn(['name' => 'circumference_of_the_upper_arm_and_wrist', 'label' => trans('backpack::common.circumference_of_the_upper_arm_and_wrist')]);
        // $this->crud->addColumn(['name' => 'waistline', 'label' => trans('backpack::common.waistline')]);
        // $this->crud->addColumn(['name' => 'hip', 'label' => trans('backpack::common.hip')]);
        // $this->crud->addColumn(['name' => 'chest', 'label' => trans('backpack::common.chest')]);
        // $this->crud->addColumn(['name' => 'thigh', 'label' => trans('backpack::common.thigh')]);

        $request = $this->crud->getRequest();
        if (!$request->has('order')) {
            $this->crud->orderBy("date", "desc");
        }
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PatientReviewRequest::class);

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

        $this->crud->addField(['name' => 'earn', 'label' => trans('backpack::common.earn') . " (بالليرة السورية) ", 'type' => 'number']);

        $this->crud->addField(
            [   // DateTime
                'name' => 'date',
                'label' => 'تاريخ المراجعة',
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

        $this->crud->addField(['name' => 'current_weight', 'label' => trans('backpack::common.current_weight'), 'type' => 'number']);
        // $this->crud->addField(['name' => 'perfect_weight', 'label' => trans('backpack::common.perfect_weight') , 'type' => 'number' ]);
        $this->crud->addField(['name' => 'fat_percentage', 'label' => trans('backpack::common.fat_percentage'), 'type' => 'text']);
        $this->crud->addField(['name' => 'fluid_ratio', 'label' => trans('backpack::common.fluid_ratio'), 'type' => 'text']);
        $this->crud->addField(['name' => 'muscle_ratio', 'label' => trans('backpack::common.muscle_ratio'), 'type' => 'text']);
        $this->crud->addField(['name' => 'physical_activity', 'label' => trans('backpack::common.physical_activity'), 'type' => 'text']);
        $this->crud->addField(['name' => 'bone_mass', 'label' => trans('backpack::common.bone_mass'), 'type' => 'text']);
        $this->crud->addField(['name' => 'age_of_the_burn', 'label' => trans('backpack::common.age_of_the_burn'), 'type' => 'text']);
        // $this->crud->addField(['name' => 'BMI', 'label' => trans('backpack::common.BMI') , 'type' => 'text' ]);
        $this->crud->addField(['name' => 'the_degree_of_obesity', 'label' => trans('backpack::common.the_degree_of_obesity'), 'type' => 'text']);
        $this->crud->addField(['name' => 'circumference_of_the_upper_arm_and_wrist', 'label' => trans('backpack::common.circumference_of_the_upper_arm_and_wrist'), 'type' => 'text']);
        $this->crud->addField(['name' => 'waistline', 'label' => trans('backpack::common.waistline'), 'type' => 'text']);
        $this->crud->addField(['name' => 'hip', 'label' => trans('backpack::common.hip'), 'type' => 'text']);
        $this->crud->addField(['name' => 'chest', 'label' => trans('backpack::common.chest'), 'type' => 'text']);
        $this->crud->addField(['name' => 'thigh', 'label' => trans('backpack::common.thigh'), 'type' => 'text']);

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
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        // CRUD::setFromDb(); // fields
        // $this->crud->removeColumn('patient_name');

        CRUD::addColumn(['name' => 'patient_form_id', 'label' => trans('backpack::common.id'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'patient_name', 'label' => trans('backpack::common.patient_name'), 'type' => 'text']);

        CRUD::addColumn(['name' => 'date', 'label' => trans('backpack::common.review_date'), 'type' => 'datetime']);
        CRUD::addColumn(['name' => 'earn', 'label' => trans('backpack::common.earn'), 'type' => 'text']);

        $this->crud->addColumn(['name' => 'patient_height', 'label' => trans('backpack::common.patient_height'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'current_weight', 'label' => trans('backpack::common.current_weight'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'perfect_weight', 'label' => trans('backpack::common.perfect_weight'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'fat_percentage', 'label' => trans('backpack::common.fat_percentage'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'fluid_ratio', 'label' => trans('backpack::common.fluid_ratio'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'muscle_ratio', 'label' => trans('backpack::common.muscle_ratio'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'physical_activity', 'label' => trans('backpack::common.physical_activity'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'bone_mass', 'label' => trans('backpack::common.bone_mass'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'age_of_the_burn', 'label' => trans('backpack::common.age_of_the_burn'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'the_degree_of_obesity', 'label' => trans('backpack::common.the_degree_of_obesity'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'circumference_of_the_upper_arm_and_wrist', 'label' => trans('backpack::common.circumference_of_the_upper_arm_and_wrist'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'waistline', 'label' => trans('backpack::common.waistline'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'hip', 'label' => trans('backpack::common.hip'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'chest', 'label' => trans('backpack::common.chest'), 'type' => 'text']);
        $this->crud->addColumn(['name' => 'thigh', 'label' => trans('backpack::common.thigh'), 'type' => 'text']);
    }




    public function patientOptions(Request $request)
    {
        $term = $request->input('term');
        $options = PatientForm::where('patient_name', 'like', '%' . $term . '%')->get()->pluck('patient_name', 'id');
        return $options;
    }
}
