<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PatientUserSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'No_SOL' => 4081801,
                'PACIENTE' => 'SANCHEZ ESTRADA EDWAR OMAR',
                'SEXO' => 'M',
                'EDAD' => 6,
                'ESCUELA' => '06DPR0473F',
                'DERECHOHABIENCIA' => null,
                'AYUNO' => 'NO',
                'GLUCOSA' => 90.11,
                'TRIGLICÉRIDOS' => 61.53,
                'COLESTEROL TOTAL' => 128.80,
                'HBA1C' => 5.27,
                'PESO' => 16.10,
                'TALLA' => 1.140,
                'IMC' => 12.39,
                'ICC' => 0.91,
                'CINTURA' => 49.00,
                'CADERA' => 54.00,
                'COMENTARIO' => 'NO AYUNO',
            ],
            [
                'No_SOL' => 4081802,
                'PACIENTE' => 'SOSA BELTRAN LUCIA',
                'SEXO' => 'F',
                'EDAD' => 7,
                'ESCUELA' => '06DPR0473F',
                'DERECHOHABIENCIA' => null,
                'AYUNO' => 'SÍ',
                'GLUCOSA' => 84.05,
                'TRIGLICÉRIDOS' => 136.70,
                'COLESTEROL TOTAL' => 131.90,
                'HBA1C' => 5.80,
                'PESO' => 31.10,
                'TALLA' => 1.290,
                'IMC' => 18.69,
                'ICC' => 0.87,
                'CINTURA' => 69.00,
                'CADERA' => 79.00,
                'COMENTARIO' => 'TV - SI AYUNO',
            ],
            [
                'No_SOL' => 4081803,
                'PACIENTE' => 'HEREDIA DIAZ JOSE ALFREDO',
                'SEXO' => 'M',
                'EDAD' => 6,
                'ESCUELA' => '06DPR0473F',
                'DERECHOHABIENCIA' => null,
                'AYUNO' => 'SÍ',
                'GLUCOSA' => 90.18,
                'TRIGLICÉRIDOS' => 98.40,
                'COLESTEROL TOTAL' => 174.83,
                'HBA1C' => 5.07,
                'PESO' => 22.10,
                'TALLA' => 1.120,
                'IMC' => 17.62,
                'ICC' => 0.95,
                'CINTURA' => 61.00,
                'CADERA' => 64.00,
                'COMENTARIO' => 'TV AYUNO',
            ],
            [
                'No_SOL' => 4081804,
                'PACIENTE' => 'SILVA ZAMORA FRANCISCO',
                'SEXO' => 'M',
                'EDAD' => 6,
                'ESCUELA' => '06DPR0473F',
                'DERECHOHABIENCIA' => null,
                'AYUNO' => 'SÍ',
                'GLUCOSA' => 82.76,
                'TRIGLICÉRIDOS' => 180.13,
                'COLESTEROL TOTAL' => 170.46,
                'HBA1C' => 5.13,
                'PESO' => 24.70,
                'TALLA' => 1.220,
                'IMC' => 16.60,
                'ICC' => 0.85,
                'CINTURA' => 64.00,
                'CADERA' => 75.00,
                'COMENTARIO' => 'TV - SI AYUNO',
            ],
        ];

        foreach ($patients as $data) {
            Patient::create(array_merge($data, [
                'CURP' => $this->generateUniqueCURP(),
                'FECHA' => Carbon::now(),
            ]));
        }
    }

    /**
     * Generate a unique 8-character CURP
     */
    private function generateUniqueCURP(): string
    {
        do {
            $curp = Str::upper(Str::random(8));
        } while (Patient::where('CURP', $curp)->exists());

        return $curp;
    }
}
