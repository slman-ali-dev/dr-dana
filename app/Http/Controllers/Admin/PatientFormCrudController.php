<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PatientFormRequest;
use App\Models\PatientForm;
use App\Models\PatientReview;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class PatientFormCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PatientFormCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation {
        show as traitShow;
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PatientForm::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/patientform');
        CRUD::setEntityNameStrings('استمارة مريض', 'استمارات المرضى');
        $this->crud->enableExportButtons();
        $this->crud->setCreateView('patient_form_create');
        $this->crud->setShowView('patient_form_show');
        $this->crud->addButtonFromView("line", "showReviews", "showreviewshistory");
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::removeButton("show");

        CRUD::addColumn([
            'name' => 'patient_with_id',
            'label' => trans('backpack::common.patient_name'),
            'type' => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('patient_name', 'like', '%' . $searchTerm . '%');  // at this own table
            }
        ]);
        CRUD::addColumn(['name' => 'gender_trans', 'label' => trans('backpack::common.gender'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'age', 'label' => trans('backpack::common.age'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'patient_height', 'label' => trans('backpack::common.patient_height'), 'type' => 'text']);
        CRUD::addColumn([
            'name' => 'weight',
            'label' => trans('backpack::common.current_weight'),
            'type' => 'text'
        ]);
        CRUD::addColumn([
            'name' => 'last_review_date',
            'label' => trans('backpack::common.last_review_date'),
            'type' => 'text'
        ]);
        CRUD::addColumn(['name' => 'phone', 'label' => trans('backpack::common.phone'), 'type' => 'text']);

        // CRUD::addColumn(['name' => 'job' , 'label'=> trans('backpack::common.job') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'qualification' , 'label'=> trans('backpack::common.qualification') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'family_status' , 'label'=> trans('backpack::common.family_status') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'pregnant' , 'label'=> trans('backpack::common.pregnant') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'breastfeeding' , 'label'=> trans('backpack::common.breastfeeding') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'period' , 'label'=> trans('backpack::common.period') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'diabetes' , 'label'=> trans('backpack::common.diabetes') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'endocrine_diseases' , 'label'=> trans('backpack::common.endocrine_diseases') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'other_diseases' , 'label'=> trans('backpack::common.other_diseases') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'past_surgery' , 'label'=> trans('backpack::common.past_surgery') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'health_assessment' , 'label'=> trans('backpack::common.health_assessment') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'gastric_ulcer' , 'label'=> trans('backpack::common.gastric_ulcer') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'Acidity' , 'label'=> trans('backpack::common.Acidity') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'colon_spasms' , 'label'=> trans('backpack::common.colon_spasms') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'diarrhea' , 'label'=> trans('backpack::common.diarrhea') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'constipation' , 'label'=> trans('backpack::common.constipation') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'vomiting' , 'label'=> trans('backpack::common.vomiting') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'nausea' , 'label'=> trans('backpack::common.nausea') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'loss_of_appetite' , 'label'=> trans('backpack::common.loss_of_appetite') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'sleep' , 'label'=> trans('backpack::common.sleep') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'smoking' , 'label'=> trans('backpack::common.smoking') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'take_certain_medications' , 'label'=> trans('backpack::common.take_certain_medications') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'the_amount_of_fluid_needed' , 'label'=> trans('backpack::common.the_amount_of_fluid_needed') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'severity_class_' , 'label'=> trans('backpack::common.severity_class_') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'daily_calories' , 'label'=> trans('backpack::common.daily_calories') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'sugars' , 'label'=> trans('backpack::common.sugars') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'protein' , 'label'=> trans('backpack::common.protein') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'fats' , 'label'=> trans('backpack::common.fats') , 'type'=>'text' ]);
        // CRUD::addColumn(['name' => 'living' , 'label'=> trans('backpack::common.living') , 'type'=>'text' ]);

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
        CRUD::setValidation(PatientFormRequest::class);

        // CRUD::setFromDb(); // fields

        CRUD::addField(['name' => 'patient_name', 'label' => trans('backpack::common.patient_name'), 'type' => 'text']);
        CRUD::addField([
            'name' => 'gender',
            'label' => trans('backpack::common.gender'),
            'type' => 'select_from_array',
            'options' => [
                'male' => 'ذكر',
                'female' => 'أنثى',
                'other' => 'غير ذلك'
            ],
        ]);
        CRUD::addField(['name' => 'age', 'label' => trans('backpack::common.age'), 'type' => 'number']);
        CRUD::addField(['name' => 'job', 'label' => trans('backpack::common.job'), 'type' => 'text']);
        CRUD::addField(['name' => 'qualification', 'label' => trans('backpack::common.qualification'), 'type' => 'text']);
        CRUD::addField(['name' => 'family_status', 'label' => trans('backpack::common.family_status'), 'type' => 'text']);
        CRUD::addField(['name' => 'pregnant', 'label' => trans('backpack::common.pregnant'), 'type' => 'text']);
        CRUD::addField(['name' => 'breastfeeding', 'label' => trans('backpack::common.breastfeeding'), 'type' => 'text']);
        CRUD::addField(['name' => 'period', 'label' => trans('backpack::common.period'), 'type' => 'text']);
        CRUD::addField(['name' => 'diabetes', 'label' => trans('backpack::common.diabetes'), 'type' => 'text']);
        CRUD::addField(['name' => 'endocrine_diseases', 'label' => trans('backpack::common.endocrine_diseases'), 'type' => 'text']);
        CRUD::addField(['name' => 'other_diseases', 'label' => trans('backpack::common.other_diseases'), 'type' => 'text']);
        CRUD::addField(['name' => 'past_surgery', 'label' => trans('backpack::common.past_surgery'), 'type' => 'text']);
        CRUD::addField(['name' => 'health_assessment', 'label' => trans('backpack::common.health_assessment'), 'type' => 'text']);
        CRUD::addField(['name' => 'gastric_ulcer', 'label' => trans('backpack::common.gastric_ulcer'), 'type' => 'text']);
        CRUD::addField(['name' => 'Acidity', 'label' => trans('backpack::common.Acidity'), 'type' => 'text']);
        CRUD::addField(['name' => 'colon_spasms', 'label' => trans('backpack::common.colon_spasms'), 'type' => 'text']);
        CRUD::addField(['name' => 'diarrhea', 'label' => trans('backpack::common.diarrhea'), 'type' => 'text']);
        CRUD::addField(['name' => 'constipation', 'label' => trans('backpack::common.constipation'), 'type' => 'text']);
        CRUD::addField(['name' => 'vomiting', 'label' => trans('backpack::common.vomiting'), 'type' => 'text']);
        CRUD::addField(['name' => 'nausea', 'label' => trans('backpack::common.nausea'), 'type' => 'text']);
        CRUD::addField(['name' => 'loss_of_appetite', 'label' => trans('backpack::common.loss_of_appetite'), 'type' => 'text']);
        CRUD::addField(['name' => 'sleep', 'label' => trans('backpack::common.sleep'), 'type' => 'text']);
        CRUD::addField(['name' => 'smoking', 'label' => trans('backpack::common.smoking'), 'type' => 'text']);
        CRUD::addField(['name' => 'take_certain_medications', 'label' => trans('backpack::common.take_certain_medications'), 'type' => 'text']);
        // CRUD::addField(['name' => 'the_amount_of_fluid_needed' , 'label'=> trans('backpack::common.the_amount_of_fluid_needed') , 'type'=>'text' ]);
        CRUD::addField(['name' => 'severity_class_', 'label' => trans('backpack::common.severity_class_'), 'type' => 'text']);
        // CRUD::addField(['name' => 'daily_calories' , 'label'=> trans('backpack::common.daily_calories') , 'type'=>'text' ]);
        CRUD::addField(['name' => 'sugars', 'label' => trans('backpack::common.sugars'), 'type' => 'text']);
        CRUD::addField(['name' => 'protein', 'label' => trans('backpack::common.protein'), 'type' => 'text']);
        CRUD::addField(['name' => 'fats', 'label' => trans('backpack::common.fats'), 'type' => 'text']);
        CRUD::addField(['name' => 'phone', 'label' => trans('backpack::common.phone'), 'type' => 'text']);
        CRUD::addField(['name' => 'living', 'label' => trans('backpack::common.living'), 'type' => 'text']);
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

        CRUD::addColumn(['name' => 'id', 'label' => trans('backpack::common.id'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'patient_name', 'label' => trans('backpack::common.patient_name'), 'type' => 'text']);
        CRUD::addColumn([
            'name' => 'gender',
            'label' => trans('backpack::common.gender'),
            'type' => 'select_from_array',
            'options' => [
                'male' => 'ذكر',
                'female' => 'أنثى',
                'other' => 'غير ذلك'
            ],
        ]);
        CRUD::addColumn(['name' => 'age', 'label' => trans('backpack::common.age'), 'type' => 'number']);
        CRUD::addColumn(['name' => 'last_review_date', 'label' => trans('backpack::common.last_review_date'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'weight', 'label' => trans('backpack::common.current_weight'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'perfect_weight', 'label' => trans('backpack::common.perfect_weight'), 'type' => 'text']);

        CRUD::addColumn(['name' => 'BMI', 'label' => trans('backpack::common.BMI'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'job', 'label' => trans('backpack::common.job'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'qualification', 'label' => trans('backpack::common.qualification'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'family_status', 'label' => trans('backpack::common.family_status'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'pregnant', 'label' => trans('backpack::common.pregnant'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'breastfeeding', 'label' => trans('backpack::common.breastfeeding'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'period', 'label' => trans('backpack::common.period'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'diabetes', 'label' => trans('backpack::common.diabetes'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'endocrine_diseases', 'label' => trans('backpack::common.endocrine_diseases'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'other_diseases', 'label' => trans('backpack::common.other_diseases'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'past_surgery', 'label' => trans('backpack::common.past_surgery'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'health_assessment', 'label' => trans('backpack::common.health_assessment'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'gastric_ulcer', 'label' => trans('backpack::common.gastric_ulcer'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'Acidity', 'label' => trans('backpack::common.Acidity'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'colon_spasms', 'label' => trans('backpack::common.colon_spasms'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'diarrhea', 'label' => trans('backpack::common.diarrhea'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'constipation', 'label' => trans('backpack::common.constipation'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'vomiting', 'label' => trans('backpack::common.vomiting'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'nausea', 'label' => trans('backpack::common.nausea'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'loss_of_appetite', 'label' => trans('backpack::common.loss_of_appetite'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'sleep', 'label' => trans('backpack::common.sleep'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'smoking', 'label' => trans('backpack::common.smoking'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'take_certain_medications', 'label' => trans('backpack::common.take_certain_medications'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'the_amount_of_fluid_needed', 'label' => trans('backpack::common.the_amount_of_fluid_needed'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'severity_class_', 'label' => trans('backpack::common.severity_class_'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'daily_calories', 'label' => trans('backpack::common.daily_calories'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'sugars', 'label' => trans('backpack::common.sugars'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'protein', 'label' => trans('backpack::common.protein'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'fats', 'label' => trans('backpack::common.fats'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'phone', 'label' => trans('backpack::common.phone'), 'type' => 'text']);
        CRUD::addColumn(['name' => 'living', 'label' => trans('backpack::common.living'), 'type' => 'text']);
    }



    public function store(Request $request)
    {
        $patientForm = PatientForm::create([
            "patient_name" => $request->patient_name,
            "gender" => $request->gender,
            "age" => $request->age,
            "job" => $request->job,
            "qualification" => $request->qualification,
            "family_status" => $request->family_status,
            "childs_no" => $request->childs_no,
            "pregnant" => $request->pregnant,
            "breastfeeding" => $request->breastfeeding,
            "period" => $request->period,
            "diabetes" => $request->diabetes,
            "endocrine_diseases" => $request->endocrine_diseases,
            "other_diseases" => $request->other_diseases,
            "past_surgery" => $request->past_surgery,
            "health_assessment_teeth" => $request->health_assessment_teeth,
            "health_assessment_gum" => $request->health_assessment_gum,
            "health_assessment_hairfall" => $request->health_assessment_hairfall,
            "gastric_ulcer" => $request->gastric_ulcer,
            "Acidity" => $request->Acidity,
            "colon_spasms" => $request->colon_spasms,
            "diarrhea" => $request->diarrhea,
            "constipation" => $request->constipation,
            "vomiting" => $request->vomiting,
            "nausea" => $request->nausea,
            "appetite" => $request->appetite,
            "sleep" => $request->sleep,
            "smoking" => $request->smoking,
            "BMI" => $request->BMI,
            "patient_height" => $request->patient_height,
            "take_certain_medications" => $request->take_certain_medications,
            "the_amount_of_fluid_needed" => $request->the_amount_of_fluid_needed,
            "severity_class_" => $request->severity_class_,
            "daily_calories" => $request->daily_calories,
            "sugars" => $request->sugars,
            "protein" => $request->protein,
            "fats" => $request->fats,
            "phone" => $request->phone,
            "address" => $request->address,
            "living" => $request->living,
            "bco" => $request->bco,
        ]);



        $patientReview = PatientReview::create([
            "patient_form_id" => $patientForm->id,
            "earn" => $request->earn,
            "date" => $request->date,
            "current_weight" => $request->current_weight,
            "perfect_weight" => $request->perfect_weight,
            "fat_percentage" => $request->fat_percentage,
            "fluid_ratio" => $request->fluid_ratio,
            "muscle_ratio" => $request->muscle_ratio,
            "physical_activity" => $request->physical_activity,
            "bone_mass" => $request->bone_mass,
            "age_of_the_burn" => $request->age_of_the_burn,
            "the_degree_of_obesity" => $request->the_degree_of_obesity,
            "circumference_of_the_upper_arm_and_wrist" => $request->circumference_of_the_upper_arm_and_wrist,
            "waistline" => $request->waistline,
            "hip" => $request->hip,
            "chest" => $request->chest,
            "thigh" => $request->thigh,
            "current_amount_of_fluid" => $request->current_amount_of_fluid,
            "date" => Carbon::now()->toDateTimeString(),

            "basal_metabolic_rate" => $request->basal_metabolic_rate,
            "general_metabolic_rate" => $request->general_metabolic_rate,
        ]);

        return redirect()->route('patientform.index');
    }




    public function reviewsHistory($patientId)
    {
        $patient = PatientForm::where('id', $patientId)->firstOrFail();
        $patientReviews = PatientReview::where('patient_form_id', $patientId)->get();
        return view("patient_reviews_history", [
            "reviews" => $patientReviews,
            "patient" => $patient
        ]);
    }


    public function show($id)
    {
        // custom logic before
        $content = $this->traitShow($id);
        // dd($content);
        // // cutom logic after
        return $content;
    }
}
