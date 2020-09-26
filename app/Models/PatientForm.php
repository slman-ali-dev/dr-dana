<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PatientForm extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'patient_forms';
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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function Reviews()
    {
        return $this->hasMany('App\Models\PatientReview', 'patient_form_id', 'id');
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

    public function getPatientWithIdAttribute(){
        return $this->patient_name . "($this->id)";
    }

    public function getGenderTransAttribute(){
        return trans("backpack::common.".$this->gender);
    }


    public function getLastReviewAttribute(){
        $res = PatientReview::where("patient_form_id" , $this->id)
                            ->whereDate("date", "<=", Carbon::now())
                            ->orderBy("date","desc")
                            ->get();
        return count($res) > 0 ? $res[0] : null;
    }

    public function getLastReviewDateAttribute(){
        $res = $this->last_review;
        return $res != null ? $res->date : "لا يوجد";
    }

    public function getWeightAttribute(){
        $res = $this->last_review;
        return $res != null ? $res->current_weight : 0;
    }

}
