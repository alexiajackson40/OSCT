<?php

namespace Database\Seeders;

use App\Models\LabResult;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class LabResultsTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = Patient::where('username', 'alicek')->first(); // Corrected to Patient model

        if ($user) {
            LabResult::create([
                'user_id' => $user->id,
                'name' => 'Blood Test Results',
                'date_assigned' => now(),
                'file_path' => 'lab_results/sample_result.pdf',
            ]);
        }
    }
}
