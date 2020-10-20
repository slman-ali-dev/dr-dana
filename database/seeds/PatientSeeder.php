<?php

use App\Helpers\CommonHelpers;
use App\Models\PatientForm;
use App\Models\PatientLaboratoryTest;
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
        $exists = [
            "يوجد",
            "لا يوجد",
            "لا يوجد",
            "لا يوجد",
        ];
        for ($i = 1; $i < 40; ++$i) {
            $gender = $genders[rand(0, 50) > 40 ? rand(0, 2) : rand(0, 1)];
            $patient = PatientForm::create([
                'patient_name' => $faker->name([$gender]),
                'gender' => $gender,
                'age' => rand(10, 85),
                'job' => $faker->jobTitle,
                'created_at' => mt_rand($startOfYear, $endOfYear),
                'patient_height' => rand(155, 200),
                'bco' => $exists[rand(0, 3)],
                'diabetes' => $exists[rand(0, 3)],
            ]);

            $reviews = rand(15, 20);
            while ($reviews-- > 0) {
                $earn = rand(2000, 7500);
                PatientReview::create([
                    'patient_form_id' => $patient->id,
                    'earn' => $earn - ($earn % 100),
                    'date' => Carbon::createFromTimestamp(rand($startOfYear, $endOfYear)),
                    'current_weight' => rand(40, 115),
                    'fat_percentage' => rand(2, 11),
                    'fluid_ratio' => rand(20, 60)
                ]);
            }


            $lab_tests = rand(1, 2);
            while ($lab_tests-- > 0) {
                PatientLaboratoryTest::create([
                    'patient_form_id' => $patient->id,
                    'ca' => rand(1, 100),
                    'date' => Carbon::createFromTimestamp(rand($startOfYear, $endOfYear)),
                    'sugar' => rand(155, 200),
                    'pigment' => rand(40, 115),
                    'cholesterol' => rand(40, 115)
                ]);
            }
        }
    }
}
