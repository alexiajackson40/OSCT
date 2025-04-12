<?php

namespace Database\Seeders;

use App\Models\Measurement;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class MeasurementsTableSeeder extends Seeder
{
    public function run(): void
    {
        $patient = Patient::where('PACIENTE', 'SANCHEZ ESTRADA EDWAR OMAR')->first();

        if ($patient) {
            Measurement::create([
                'user_id' => $patient->CURP,
                'waist' => $patient->CINTURA,
                'hip' => $patient->CADERA,
                'waist_hip_ratio' => $patient->ICC,
                'body_mass' => $patient->IMC,
                'cholesterol' => $patient->{'COLESTEROL TOTAL'},
                'glucose_level' => $patient->GLUCOSA,
                'hemoglobin' => $patient->HBA1C,
                'triglycerides' => $patient->{'TRIGLICÉRIDOS'},
            ]);
        }
    }
}
