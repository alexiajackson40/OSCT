<?php

namespace Database\Seeders;

use App\Models\LabResult;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class LabResultsTableSeeder extends Seeder
{
    public function run(): void
    {
        $patient = Patient::where('PACIENTE', 'SANCHEZ ESTRADA EDWAR OMAR')->first(); // Corrected to Patient model

        if ($patient) {
            LabResult::create([
                'user_id' => $patient->CURP,
                'name' => 'Blood Test Results',
                'date_assigned' => now(),
                'file_path' => 'lab_results/sample_result.pdf',
            ]);
        }
    }
}