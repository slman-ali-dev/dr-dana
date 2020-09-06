<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PatientLaboratoryTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboratory_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_form_id');

            $table->string('sugar')->nullable();
            $table->string('pigment')->nullable();
            $table->string('cholesterol')->nullable();
            $table->string('triple_lipids')->nullable();
            $table->string('ca')->nullable();
            $table->string('na')->nullable();
            $table->string('k')->nullable();
            $table->string('total_protein')->nullable();

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
        Schema::table('laboratory_tests', function (Blueprint $table) {
            //
        });
    }
}
