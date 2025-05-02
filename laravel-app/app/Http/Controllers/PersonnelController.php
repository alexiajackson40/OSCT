<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Measurement;
use App\Models\LabResult;
use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\Patient;
use App\Models\Document;
use App\Models\Schedule;


class PersonnelController extends Controller
{
    public function home() {
        return view('personnel_user.home');
    }

    public function personnelProfile($id)
    {
        $user = Personnel::findOrFail($id);
        return view('personnel_user.profile', compact('user'));
    }

    public function editProfile($id)
    {
        $user = \App\Models\Personnel::findOrFail($id);
        return view('personnel_user.edit_profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = \App\Models\Personnel::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($request->only(['first_name', 'last_name', 'phone', 'address']));
    
        return redirect()->route('personnel.profile', $id)->with('success', 'Perfil actualizado.');
    }

    public function users()
    {
        $patients = \App\Models\Patient::all();
        return view('personnel_user.users', compact('patients'));
    }    

    public function patientLabResults($id)
    {
        $labResults = LabResult::where('user_id', $id)->get();
        $patient = Patient::findOrFail($id);  // Corrected to fetch from the patients table
        return view('personnel_user.users.patient_labResults', compact('labResults', 'patient'));
    }
    
    public function patientMeasurements($id)
    {
        $patient = Patient::where('CURP', $id)->firstOrFail();
        $measurements = Measurement::where('user_id', $id)->get(); // not ->exists() or ->first()
        return view('personnel_user.users.patient_measurements', compact('patient', 'measurements'));
    }
    
    public function updateMeasurement(Request $request, $id)
    {
        // Fetch the patient using CURP
        $patient = Patient::where('CURP', $id)->firstOrFail();
    
        // Update measurements and synchronize with patients table
        foreach ($request->input('measurements', []) as $measurementId => $data) {
            $measurement = Measurement::findOrFail($measurementId);
            $measurement->update($data);
    
            // Update relevant fields in the patients table
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
    
        return redirect()->route('personnel.patientMeasurements', $patient->CURP)
            ->with('success', '¡Medidas actualizadas exitosamente y sincronizadas con los registros del alumno!');
    }

    public function patientProfile($id)
    {
        $patient = Patient::findOrFail($id);  // Corrected to fetch from the patients table
        return view('personnel_user.users.patient_profile', compact('patient'));
    }

    public function updatePatient(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'school_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'age' => 'required|numeric',
            'fasting_status' => 'nullable|string',
            'glucose' => 'nullable|numeric',
            'triglycerides' => 'nullable|numeric',
            'total_cholesterol' => 'nullable|numeric',
            'hba1c' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'bmi' => 'nullable|numeric',
            'icc' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'hip' => 'nullable|numeric',
            'comments' => 'nullable|string',
        ]);
    
        $patient = Patient::where('CURP', $id)->firstOrFail();
    
        $patient->update([
            'PACIENTE' => $request->input('first_name'),
            'ESCUELA' => $request->input('school_name'),
            'SEXO' => $request->input('gender'),
            'EDAD' => $request->input('age'),
            'AYUNO' => $request->input('fasting_status'),
            'GLUCOSA' => $request->input('glucose'),
            'TRIGLICÉRIDOS' => $request->input('triglycerides'),
            'COLESTEROL TOTAL' => $request->input('total_cholesterol'),
            'HBA1C' => $request->input('hba1c'),
            'PESO' => $request->input('weight'),
            'TALLA' => $request->input('height'),
            'IMC' => $request->input('bmi'),
            'ICC' => $request->input('icc'),
            'CINTURA' => $request->input('waist'),
            'CADERA' => $request->input('hip'),
            'COMENTARIO' => $request->input('comments'),
        ]);
    
        return redirect()->route('personnel.patientProfile', $id)->with('success', '¡Perfil del alumno actualizado exitosamente!');
    }    

    public function documents($id)
    {
        $patient = Patient::findOrFail($id);
        $documents = Document::where('user_id', $id)->get();
    
        return view('personnel_user.users.patient_documents', compact('patient', 'documents'));
    }

    public function uploadDocument(Request $request, $id)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_file' => 'required|file|mimes:pdf,doc,docx,png,jpg|max:10240',
        ]);
    
        $patient = Patient::where('CURP', $id)->firstOrFail();
    
        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('documents'), $filename);
    
            Document::create([
                'name' => $request->input('document_name'),
                'file_path' => 'documents/' . $filename,
                'user_id' => $patient->CURP,
            ]);
        }
    
        return redirect()->route('personnel.documents', $id)->with('success', '¡Documento cargado exitosamente!');
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
                'user_id' => $patient->CURP,
                'name' => $request->input('name'),
                'file_path' => 'lab_results/' . $filename,
                'date_assigned' => now()->toDateString(),
            ]);
        }
    
        return redirect()->route('personnel.patientLabResults', $id)->with('success', '¡Resultado de laboratorio cargado exitosamente!');
    }    

    // Delete Document (Personnel)
    public function deleteDocument($id)
    {
        $document = Document::findOrFail($id);
        $filePath = public_path($document->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $document->delete();

        return redirect()->back()->with('success', '¡Documento eliminado exitosamente!');
    }

    // Delete Lab Result (Personnel)
    public function deleteLabResult($id)
    {
        $labResult = LabResult::findOrFail($id);
        $filePath = public_path($labResult->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $labResult->delete();

        return redirect()->back()->with('success', '¡Resultado de laboratorio eliminado exitosamente!');
    } 
    
    public function schedule()
    {
        $schedules = Schedule::all();
        
        return view('personnel_user.schedule', compact('schedules'));
    } 

    public function editSchedule($id)
    {
    $schedule = Schedule::findOrFail($id);
    return view('personnel_user.edit_schedule', compact('schedule'));
    }

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|string',
            'shift' => 'required|string',
            'cct' => 'required|string',
            'school_name' => 'required|string',
            'municipality' => 'required|string',
            'locality' => 'required|string',
            'address' => 'required|string',
            'total_students' => 'required|numeric',
            'date' => 'required|date',
        ]);
    
        $schedule = Schedule::findOrFail($id);
    
        $schedule->update([
            'level' => $request->input('level'),
            'shift' => $request->input('shift'),
            'cct' => $request->input('cct'),
            'school_name' => $request->input('school_name'),
            'municipality' => $request->input('municipality'),
            'locality' => $request->input('locality'),
            'address' => $request->input('address'),
            'total_students' => $request->input('total_students'),
            'date' => $request->input('date'),
        ]);

    return redirect()->route('personnel.schedule')->with('success', 'Horario actualizado exitosamente.');
}

public function uploadSchedule(Request $request)
    {
        $request->validate([
            'schedule_file' => 'required|mimes:csv,txt|max:2048',
        ]);
    
        if ($request->hasFile('schedule_file')) {
            \Log::info('File upload detected. Starting schedule processing.');
    
            $file = $request->file('schedule_file');
            $filePath = $file->getRealPath();
    
            $fileHandle = fopen($filePath, 'r');
            $header = fgetcsv($fileHandle);
    
            \Log::info('CSV Header:', ['header' => $header]);
    
            $expectedColumns = [
                'NIVEL', 'TURNO', 'CCT', 'NOMBRE DE LA ESCUELA',
                'MUNICIPIO', 'LOCALIDAD', 'DOMICILIO',
                'TOTAL DE ALUMNOS', 'FECHA'
            ];
    
            $truncatedHeader = array_slice($header, 0, count($expectedColumns));
    
            if ($truncatedHeader !== $expectedColumns) {
                fclose($fileHandle);
                \Log::error('CSV header does not match expected format.', [
                    'expected' => $expectedColumns,
                    'actual' => $header,
                ]);
                return back()->with('error', 'Formato de CSV inválido. Asegúrate que los encabezados coincidan: ' . implode(', ', $expectedColumns));
            }
    
            $schedules = [];
            $errors = [];
            $rowIndex = 1;
    
            while (($row = fgetcsv($fileHandle)) !== false) {
                $rowIndex++;
                \Log::info("Processing row $rowIndex:", $row);
    
                $row = array_slice($row, 0, count($expectedColumns));
                \Log::info("Truncated row $rowIndex:", $row);
    
                if (empty(array_filter($row)) || count($row) !== count($expectedColumns)) {
                    $errors[] = "Fila inválida en el índice $rowIndex. Saltando.";
                    \Log::warning("Row $rowIndex skipped due to empty or mismatched columns.", $row);
                    continue;
                }
    
                $rowData = @array_combine($expectedColumns, $row);
                if (!$rowData) {
                    $errors[] = "La fila en el índice $rowIndex no pudo ser procesada. Saltando.";
                    \Log::warning("Row $rowIndex could not be processed. Data:", $row);
                    continue;
                }
    
                $fechaRaw = trim($rowData['FECHA']);
                \Log::info("Raw FECHA value for row $rowIndex: '$fechaRaw'");
    
                $fechaCleaned = preg_replace('/^[A-ZÁÉÍÓÚÑ]+\s+/u', '', $fechaRaw);
                $fechaCleaned = preg_replace('/\s+/', '', $fechaCleaned);
                \Log::info("Sanitized FECHA value for row $rowIndex: '$fechaCleaned'");
    
                try {
                    $date = \Carbon\Carbon::createFromFormat('d/m/y', $fechaCleaned)->format('Y-m-d');
                    \Log::info("Parsed date for row $rowIndex: '$fechaCleaned' → '$date'");
                } catch (\Exception $e) {
                    $errors[] = "Formato de fecha inválido en la fila $rowIndex: '$fechaRaw'. Saltando.";
                    \Log::error("Date parsing error for row $rowIndex: '$fechaRaw' → '$fechaCleaned'", ['error' => $e->getMessage()]);
                    continue;
                }
    
                $schedules[] = [
                    'level' => $rowData['NIVEL'],
                    'shift' => $rowData['TURNO'],
                    'cct' => $rowData['CCT'],
                    'school_name' => $rowData['NOMBRE DE LA ESCUELA'],
                    'municipality' => $rowData['MUNICIPIO'],
                    'locality' => $rowData['LOCALIDAD'],
                    'address' => $rowData['DOMICILIO'],
                    'total_students' => is_numeric($rowData['TOTAL DE ALUMNOS']) ? (int) $rowData['TOTAL DE ALUMNOS'] : null,
                    'date' => $date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
    
            fclose($fileHandle);
    
            try {
                if (!empty($schedules)) {
                    \DB::table('schedule')->insert($schedules);
                    \Log::info(count($schedules) . ' schedules inserted successfully.');
                }
    
                $successMessage = count($schedules) . ' horarios cargados exitosamente.';
                if (!empty($errors)) {
                    $successMessage .= '<br>Se produjeron algunos errores:<br>' . implode('<br>', $errors);
                }
    
                return back()->with('success', $successMessage);
            } catch (\Exception $e) {
                \Log::error('Database insertion error', ['error' => $e->getMessage()]);
                return back()->with('error', 'Error al cargar: ' . $e->getMessage());
            }
        }
    
        \Log::error('No file uploaded.');
        return back()->with('error', 'No se subió ningún archivo.');
    }

    public function changePasswordForm($id)
    {
        $user = Personnel::findOrFail($id);
        return view('personnel_user.change_password', compact('user'));
    }
    
    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $personnel = \App\Models\Personnel::findOrFail($id);
    
        if (!\Hash::check($request->current_password, $personnel->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        $personnel->password = $request->password;
        $personnel->save();
    
        return redirect()->route('personnel.profile', $id)->with('success', 'Contraseña actualizada exitosamente.');
    }    
    
}
