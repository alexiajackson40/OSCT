<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $patient = Patient::where('PACIENTE', 'SANCHEZ ESTRADA EDWAR OMAR')->first();

        if ($patient) {
            Document::create([
                'user_id' => $patient->CURP,
                'name' => 'Medical Clearance Form',
                'date_assigned' => now(),
                'file_path' => 'documents/sample.pdf',
            ]);
        }
    }
}