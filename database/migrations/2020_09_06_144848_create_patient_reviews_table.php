<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('patient_form_id');
            $table->integer('earn')->unsigned()->default(0);
            
            $table->string('patient_height')->nullable();
            $table->string('current_weight')->nullable();
            $table->string('perfect_weight')->nullable();
            $table->string('fat_percentage')->nullable();
            $table->string('fluid_ratio')->nullable();
            $table->string('muscle_ratio')->nullable();
            $table->string('physical_activity')->nullable();
            $table->string('bone_mass')->nullable();
            $table->string('age_of_the_burn')->nullable();
            $table->string('BMI')->nullable();
            $table->string('the_degree_of_obesity')->nullable();
            $table->string('circumference_of_the_upper_arm_and_wrist')->nullable();
            $table->string('waistline')->nullable();
            $table->string('hip')->nullable();
            $table->string('the_chest')->nullable();
            $table->string('thigh')->nullable();


                

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_reviews');
    }
}