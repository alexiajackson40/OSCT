<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Personnel;
use App\Models\Admin;
use App\Models\Measurement;
use App\Models\Document;
use App\Models\LabResult;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Carbon;

class AdminUsersController extends Controller
{
    public function patientUsers()
    {
        $patients = Patient::all();
        return view('admin_user.users.patient_users', compact('patients'));
    }

    public function personnelUsers()
    {
        $personnel = Personnel::all();
        return view('admin_user.users.personnel_users', compact('personnel'));
    }

    public function adminUsers()
    {
        $admins = Admin::all();
        return view('admin_user.users.admin_users', compact('admins'));
    }

    public function adminProfile($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin_user.users.admin_profile', compact('admin'));
    }

    public function removeAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.adminUsers')->with('success', 'Administrador eliminado exitosamente.');
    }

    public function removePersonnel($id)
    {
        $personnel = \App\Models\Personnel::findOrFail($id);
        $personnel->delete();

        return redirect()->route('admin.personnelUsers')->with('success', 'Personal de Salud eliminado exitosamente.');
    }

    public function personnelProfile($id)
    {
        $personnel = \App\Models\Personnel::findOrFail($id);
        return view('admin_user.users.personnel_profile', compact('personnel'));
    }

    public function updatePersonnel(Request $request, $id)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'phone'         => 'nullable|string|max:15',
            'address'       => 'nullable|string|max:255',
        ]);

        $personnel = \App\Models\Personnel::where('employee_id', $id)->firstOrFail();

        $personnel->update([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'phone'         => $request->input('phone'),
            'address'       => $request->input('address'),
        ]);

        return redirect()->route('admin.users.personnel_profile', $id)
            ->with('success', 'Información del Personal de Salud actualizada exitosamente.');
    }

    public function addPatient(Request $request)
    {
        $request->validate([
            'first_name'        => 'required|string|max:255',
            'gender'            => 'required|string|max:2',
            'age'               => 'required|numeric',
            'school_name'       => 'required|string|max:255',
            'DERECHOHABIENCIA'  => 'nullable|string|max:255',
            'fasting_status'    => 'nullable|string|max:10',
            'glucose'           => 'nullable|numeric',
            'triglycerides'     => 'nullable|numeric',
            'total_cholesterol' => 'nullable|numeric',
            'hba1c'             => 'nullable|numeric',
            'weight'            => 'nullable|numeric',
            'height'            => 'nullable|numeric',
            'bmi'               => 'nullable|numeric',
            'waist'             => 'nullable|numeric',
            'hip'               => 'nullable|numeric',
            'icc'               => 'nullable|numeric',
            'comments'          => 'nullable|string',
        ]);

        $patientName = trim($request->input('first_name'));

        $existingPatient = Patient::where('PACIENTE', $patientName)->first();
        if ($existingPatient) {
            return redirect()->route('admin.patientUsers')
                ->with('error', 'Paciente duplicado detectado: ' . $patientName);
        }

        $curp = $this->generateUniqueCURP();
        $maxNoSol = Patient::max('No_SOL');
        $noSol = $maxNoSol ? $maxNoSol + 1 : 4081805;

        Patient::create([
            'No_SOL'            => $noSol,
            'FECHA'             => now()->toDateTimeString(),
            'CURP'              => $curp,
            'PACIENTE'          => $patientName,
            'SEXO'              => $request->input('gender'),
            'EDAD'              => $request->input('age'),
            'ESCUELA'           => $request->input('school_name'),
            'DERECHOHABIENCIA'  => $request->input('DERECHOHABIENCIA'),
            'AYUNO'             => $request->input('fasting_status'),
            'GLUCOSA'           => $request->input('glucose'),
            'TRIGLICÉRIDOS'     => $request->input('triglycerides'),
            'COLESTEROL TOTAL'  => $request->input('total_cholesterol'),
            'HBA1C'             => $request->input('hba1c'),
            'PESO'              => $request->input('weight'),
            'TALLA'              => $request->input('height'),
            'IMC'               => $request->input('bmi'),
            'ICC'               => $request->input('icc'),
            'CINTURA'           => $request->input('waist'),
            'CADERA'            => $request->input('hip'),
            'COMENTARIO'        => $request->input('comments'),
        ]);

        return redirect()->route('admin.patientUsers')->with('success', 'Paciente agregado exitosamente.');
    }

    public function importPatients(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $filePath = $file->getRealPath();
            $fileHandle = fopen($filePath, 'r');
            $header = fgetcsv($fileHandle);

            $expectedColumns = [
                'No. SOL.', 'FECHA', 'CURP', 'PACIENTE', 'SEXO', 'EDAD', 'ESCUELA',
                'DERECHOHABIENCIA', 'AYUNO', 'GLUCOSA', 'TRIGLICÉRIDOS',
                'COLESTEROL TOTAL', 'HBA1C', 'PESO', 'TALLA', 'IMC', 'ICC', 'CINTURA', 'CADERA', 'COMENTARIO'
            ];
            if ($header !== $expectedColumns) {
                fclose($fileHandle);
                return back()->with('error', 'El formato del archivo CSV es inválido. Asegúrate de incluir: ' . implode(', ', $expectedColumns));
            }

            $patients = [];
            $errors = [];

            while (($row = fgetcsv($fileHandle)) !== false) {
                if (empty(array_filter($row)) || empty(trim($row[0]))) {
                    continue;
                }

                preg_match('/\d+/', $row[5], $ageMatches);
                $age = $ageMatches[0] ?? null;

                $patientName = trim($row[3]);
                $existingPatient = Patient::where('PACIENTE', $patientName)->first();
                if ($existingPatient) {
                    $errors[] = "Paciente duplicado detectado: {$patientName}";
                    continue;
                }

                $curpRaw = trim($row[2]);
                if (!$curpRaw || strlen($curpRaw) != 8 || stripos($curpRaw, 'GENERAR') !== false) {
                    $curp = $this->generateUniqueCURP();
                } else {
                    $curp = $curpRaw;
                }

                $ayunoRaw = trim($row[8]);
                if (in_array($ayunoRaw, ['SÍ', 'NO'])) {
                    $ayuno = $ayunoRaw;
                } else {
                    if (stripos($ayunoRaw, 'no') !== false) {
                        $ayuno = 'NO';
                    } elseif (stripos($ayunoRaw, 'si') !== false) {
                        $ayuno = 'SÍ';
                    } else {
                        $ayuno = null;
                    }
                }

                $patients[] = [
                    'No_SOL'           => $row[0],
                    'FECHA'            => $row[1] ? $row[1] : now(),
                    'CURP'             => $curp,
                    'PACIENTE'         => $patientName,
                    'SEXO'             => $row[4],
                    'EDAD'             => $age,
                    'ESCUELA'          => $row[6],
                    'DERECHOHABIENCIA' => trim($row[7]) !== '' ? $row[7] : null,
                    'AYUNO'            => $ayuno,
                    'GLUCOSA'          => is_numeric($row[9]) ? $row[9] : null,
                    'TRIGLICÉRIDOS'    => is_numeric($row[10]) ? $row[10] : null,
                    'COLESTEROL TOTAL' => is_numeric($row[11]) ? $row[11] : null,
                    'HBA1C'            => is_numeric($row[12]) ? $row[12] : null,
                    'PESO'             => is_numeric($row[13]) ? $row[13] : null,
                    'TALLA'            => is_numeric($row[14]) ? $row[14] : null,
                    'IMC'              => is_numeric($row[15]) ? $row[15] : null,
                    'ICC'              => is_numeric($row[16]) ? $row[16] : null,
                    'CINTURA'          => is_numeric($row[17]) ? $row[17] : null,
                    'CADERA'           => is_numeric($row[18]) ? $row[18] : null,
                    'COMENTARIO'       => $row[19],
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ];
            }
            fclose($fileHandle);

            try {
                Patient::insert($patients);
                $successMessage = count($patients) . ' pacientes importados exitosamente.';
                if (!empty($errors)) {
                    $successMessage .= '<br>Errores: ' . implode('<br>', $errors);
                }
                return back()->with('success', $successMessage);
            } catch (\Exception $e) {
                return back()->with('error', 'Error durante la importación: ' . $e->getMessage());
            }
        }
    }

    private function generateUniqueCURP(): string
    {
        do {
            $curp = Str::upper(Str::random(8));
        } while (Patient::where('CURP', $curp)->exists());

        return $curp;
    }

    public function removePatient($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('admin.patientUsers')->with('success', 'Paciente eliminado exitosamente.');
    }

    public function patientProfile($id)
    {
        $patient = Patient::findOrFail($id);
        return view('admin_user.users.patient_profile', compact('patient'));
    }

    public function updatePatient(Request $request, $id)
    {
        $request->validate([
            'first_name'        => 'required|string|max:255',
            'school_name'       => 'required|string|max:255',
            'gender'            => 'required|string|max:10',
            'age'               => 'required|numeric',
            'fasting_status'    => 'nullable|string|max:10',
            'glucose'           => 'nullable|numeric',
            'triglycerides'     => 'nullable|numeric',
            'total_cholesterol' => 'nullable|numeric',
            'hba1c'             => 'nullable|numeric',
            'weight'            => 'nullable|numeric',
            'height'            => 'nullable|numeric',
            'bmi'               => 'nullable|numeric',
            'icc'               => 'nullable|numeric',
            'waist'             => 'nullable|numeric',
            'hip'               => 'nullable|numeric',
            'comments'          => 'nullable|string',
        ]);

        $patient = Patient::where('CURP', $id)->firstOrFail();

        $patient->update([
            'PACIENTE'          => $request->input('first_name'),
            'ESCUELA'           => $request->input('school_name'),
            'SEXO'              => $request->input('gender'),
            'EDAD'              => $request->input('age'),
            'AYUNO'             => $request->input('fasting_status'),
            'GLUCOSA'           => $request->input('glucose'),
            'TRIGLICÉRIDOS'     => $request->input('triglycerides'),
            'COLESTEROL TOTAL'  => $request->input('total_cholesterol'),
            'HBA1C'             => $request->input('hba1c'),
            'PESO'              => $request->input('weight'),
            'TALLA'             => $request->input('height'),
            'IMC'               => $request->input('bmi'),
            'ICC'               => $request->input('icc'),
            'CINTURA'           => $request->input('waist'),
            'CADERA'            => $request->input('hip'),
            'COMENTARIO'        => $request->input('comments'),
        ]);

        return redirect()->route('admin.users.patient_profile', $id)->with('success', 'Perfil del paciente actualizado exitosamente.');
    }

    public function patientMeasurements($id)
    {
        $patient = Patient::where('CURP', $id)->firstOrFail();
        $measurements = Measurement::where('user_id', $patient->CURP)->get();

        return view('admin_user.users.patient_measurements', compact('measurements', 'patient'));
    }

    public function updateMeasurement(Request $request, $id)
    {
        $patient = Patient::where('CURP', $id)->firstOrFail();

        foreach ($request->input('measurements', []) as $measurementId => $data) {
            $measurement = Measurement::findOrFail($measurementId);
            $measurement->update($data);

            $patient->update([
                'GLUCOSA' => $measurement->glucose_level,
                'TRIGLICÉRIDOS' => $measurement->triglycerides,
                'COLESTEROL TOTAL' => $measurement->cholesterol,
                'HBA1C' => $measurement->hemoglobin,
                'IMC' => $measurement->body_mass,
                'ICC' => $measurement->waist_hip_ratio,
                'CINTURA' => $measurement->waist,
                'CADERA' => $measurement->hip,
            ]);
        }

        return redirect()->route('admin.users.patient_measurements', $patient->CURP)
            ->with('success', 'Mediciones actualizadas y sincronizadas exitosamente.');
    }

    public function patientLabResults($id)
    {
        $patient = Patient::where('CURP', $id)->firstOrFail();
        $labResults = LabResult::where('user_id', $patient->CURP)->get();

        return view('admin_user.users.patient_labResults', compact('labResults', 'patient'));
    }

    public function uploadLabResult(Request $request, $id)
    {
        $request->validate([
            'lab_result' => 'required|file|mimes:pdf,jpg,png|max:10240',
            'name'       => 'required|string|max:255',
        ]);

        $patient = Patient::where('CURP', $id)->firstOrFail();

        if ($request->hasFile('lab_result')) {
            $file = $request->file('lab_result');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('lab_results'), $filename);

            LabResult::create([
                'user_id'       => $patient->CURP,
                'name'          => $request->input('name'),
                'file_path'     => 'lab_results/' . $filename,
                'date_assigned' => now()->toDateString(),
            ]);
        }

        return redirect()->route('admin.users.patient_labResults', $patient->CURP)
            ->with('success', 'Resultado de laboratorio subido exitosamente.');
    }

    public function downloadLabResult($id)
    {
        $labResult = LabResult::findOrFail($id);
        $filePath = public_path($labResult->file_path);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        return redirect()->back()->with('error', 'Resultado de laboratorio no encontrado.');
    }

    public function deleteLabResult($id)
    {
        $labResult = LabResult::findOrFail($id);
        $filePath = public_path($labResult->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $labResult->delete();

        return redirect()->back()->with('success', 'Resultado de laboratorio eliminado exitosamente.');
    }

    public function allPatientDocuments($id)
    {
        $patient = Patient::where('CURP', $id)->firstOrFail();
        $documents = Document::where('user_id', $patient->CURP)->get();

        return view('admin_user.users.patient_documents', compact('documents', 'patient'));
    }

    public function uploadDocument(Request $request, $id)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_file' => 'required|file|mimes:pdf,doc,docx,png,jpg|max:10240',
        ]);

        $patient = Patient::where('CURP', $id)->firstOrFail();

        if ($request->hasFile('document_file') && $request->file('document_file')->isValid()) {
            $file = $request->file('document_file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('documents'), $filename);

            Document::create([
                'name'      => $request->input('document_name'),
                'file_path' => 'documents/' . $filename,
                'user_id'   => $patient->CURP,
            ]);

            return redirect()->route('admin.users.patient_documents', $id)
                ->with('success', 'Documento subido exitosamente.');
        }

        return back()->with('error', 'Error al subir el archivo.');
    }

    public function deleteDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $filePath = public_path($document->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $document->delete();

        return redirect()->back()->with('success', 'Documento eliminado exitosamente.');
    }

    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $filePath = public_path($document->file_path);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        return redirect()->back()->with('error', 'Archivo no encontrado.');
    }

    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|string|email|max:255',
            'phone'      => 'nullable|string|max:15',
        ]);

        $admin = \App\Models\Admin::findOrFail($id);

        $admin->update([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'email'      => $request->input('email'),
            'phone'      => $request->input('phone'),
        ]);

        return redirect()->route('admin.users.admin_profile', $id)
            ->with('success', 'Perfil del administrador actualizado exitosamente.');
    }
}
