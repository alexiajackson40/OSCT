<?php

namespace Database\Seeders;

use App\Models\LabResult;
use App\Models\User;
use Illuminate\Database\Seeder;

class LabResultsTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('username', 'alicek')->first();

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
