<?php

use App\Helpers\CommonHelpers;
use App\Models\PatientForm;
use App\Models\PatientReview;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $genders = CommonHelpers::getGenders();


        $date = Carbon::createFromDate(2020, 1, 1);

        $startOfYear = $date->copy()->startOfYear()->timestamp;
        $endOfYear   = $date->copy()->endOfYear()->timestamp;

        for ($i = 1; $i < 500; ++$i) {
            $gender = $genders[rand(0,50) > 40 ? rand(0, 2) : rand(0,1)];
            $patient = PatientForm::create([
                'patient_name' => $faker->name([$gender]),
                'gender' => $gender,
                'age' => rand(10, 85),
                'job' => $faker->jobTitle,
                'created_at' => mt_rand($startOfYear,$endOfYear)
            ]);
            
            $reviews = rand(1, 5);
            while ($reviews-- > 0) {
                $earn = rand(2000,7500);
                PatientReview::create([
                    'patient_form_id' => $patient->id,
                    'earn' => $earn - ($earn % 100),
                    'created_at' => rand($startOfYear,$endOfYear)
                ]);
            }
        }
    }
}
