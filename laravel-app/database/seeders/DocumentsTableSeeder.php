<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = Patient::where('username', 'alicek')->first(); // Corrected to Patient model

        if ($user) {
            Document::create([
                'user_id' => $user->id,
                'name' => 'Medical Clearance Form',
                'date_assigned' => now(),
                'file_path' => 'documents/sample.pdf',
            ]);
        }
    }
}
