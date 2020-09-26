<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class PatientReview extends Model
{
    use CrudTrait;


    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'patient_reviews';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */


    public function __construct(array $attributes = [])
    {
        $this->creating([$this, 'onCreating']);
        $this->updating([$this, 'onUpdating']);


        parent::__construct($attributes);
    }


    public function onCreating(PatientReview $row)
    {
        $patient = $row->patient;

        $height_m = $row->patient_height / 10;

        if ($height_m != 0) {
            $patient->BMI = $row->current_weight / ($height_m * $height_m);
            $patient->BMI = number_format((float)$patient->BMI, 4, '.', '');
        }

        if ($row->current_weight > 0) {
            $patient->the_amount_of_fluid_needed = 175 + ($row->current_weight * 15);
        }
        if ($row->patient->gender == "male" && $row->patient_height > 0 && $row->current_weight > 0) {
            $patient->daily_calories = 655.10 + (6.56 * $row->current_weight) + (1.85 * $row->patient_height) - (4.68 * $patient->age);
        } else if ($row->patient->gender == "female" && $row->patient_height > 0 && $row->current_weight > 0) {
            $patient->daily_calories = 66.7 + (13.75 * $row->current_weight) + (5 * $row->patient_height) - (6.76 * $patient->age);
        }

        if ($row->patient_height > 0) {
            $patient->perfect_weight = 100 - ($row->patient_height - 150) / 4;
        }

        $patient->save();
    }

    public function onUpdating(PatientReview $row)
    {

        $patient = $row->patient;

        $height_m = $row->patient_height / 10;

        if ($height_m != 0) {
            $patient->BMI = $row->current_weight / ($height_m * $height_m);
            $patient->BMI = number_format((float)$patient->BMI, 4, '.', '');
        }

        if ($row->current_weight > 0) {
            $patient->the_amount_of_fluid_needed = 175 + ($row->current_weight * 15);
        }
        if ($row->patient->gender == "male" && $row->patient_height > 0 && $row->current_weight > 0) {
            $patient->daily_calories = 655.10 + (6.56 * $row->current_weight) + (1.85 * $row->patient_height) - (4.68 * $patient->age);
        } else if ($row->patient->gender == "female" && $row->patient_height > 0 && $row->current_weight > 0) {
            $patient->daily_calories = 66.7 + (13.75 * $row->current_weight) + (5 * $row->patient_height) - (6.76 * $patient->age);
        }

        if ($row->patient_height > 0) {
            $patient->perfect_weight = 100 - ($row->patient_height - 150) / 4;
        }

        $patient->save();
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function Patient()
    {
        return $this->belongsTo('App\Models\PatientForm', 'patient_form_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function getPatientWithIdAttribute()
    {
        return $this->Patient->patient_with_id;
    }
}
