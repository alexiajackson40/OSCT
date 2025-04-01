<?php

namespace Database\Seeders;

use App\Models\Measurement;
use App\Models\User;
use Illuminate\Database\Seeder;

class MeasurementsTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('username', 'alicek')->first();

        if ($user) {
            Measurement::create([
                'user_id' => $user->id,
                'waist' => 60.0,
                'hip' => 85.0,
                'waist_hip_ratio' => 0.71,
                'body_mass' => 18.5,
                'cholesterol' => 150.0,
                'glucose_level' => 90.0,
                'hemoglobin' => 13.5,
                'triglycerides' => 100.0,
            ]);
        }
    }
}
