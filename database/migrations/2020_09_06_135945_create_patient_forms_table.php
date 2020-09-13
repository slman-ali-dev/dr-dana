<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_name');
            $table->enum('gender', ['male', 'female','other']);
            $table->integer('age')->nullable();
            $table->string('job')->nullable();
            $table->string('qualification')->nullable();
            $table->string('family_status')->nullable();
            $table->string('pregnant')->nullable();
            $table->string('breastfeeding')->nullable();
            $table->string('period')->nullable();
            $table->string('diabetes')->nullable();
            $table->string('endocrine_diseases')->nullable();
            $table->string('other_diseases')->nullable();
            $table->string('past_surgery')->nullable();
            $table->string('health_assessment')->nullable();
            $table->string('gastric_ulcer')->nullable();
            $table->string('Acidity')->nullable();
            $table->string('colon_spasms')->nullable();
            $table->string('diarrhea')->nullable();
            $table->string('constipation')->nullable();
            $table->string('vomiting')->nullable();
            $table->string('nausea')->nullable();
            $table->string('loss_of_appetite')->nullable();
            $table->string('sleep')->nullable();
            $table->string('smoking')->nullable();

            $table->string('take_certain_medications')->nullable();
            $table->string('the_amount_of_fluid_needed')->nullable();
            $table->string('severity_class_')->nullable();
            $table->string('daily_calories')->nullable();
            $table->string('sugars')->nullable();
            $table->string('protein')->nullable();
            $table->string('fats')->nullable();
            $table->string('the_phone')->nullable();
            $table->string('living')->nullable();

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
        Schema::dropIfExists('patient_forms');
    }
}
