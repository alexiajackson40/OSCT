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
    // Fetch Patient Users
    public function patientUsers()
    {
        $patients = Patient::all(); // Fetch from the patients table
        return view('admin_user.users.patient_users', compact('patients'));
    }

    // Fetch Personnel Users
    public function personnelUsers()
    {
        $personnel = Personnel::all(); // Fetch from the personnel table
        return view('admin_user.users.personnel_users', compact('personnel'));
    }

    // Fetch Admin Users
    public function adminUsers()
    {
        $admins = Admin::all(); // Fetch from the admins table
        return view('admin_user.users.admin_users', compact('admins'));
    }

    // Add Patient
    public function addPatient(Request $request)
    {
        // Validate inputs based on the fields provided in your view
        $request->validate([
            'first_name'        => 'required|string|max:255', // Full patient name; will be stored in PACIENTE
            'gender'            => 'required|string|max:2',   // e.g., "M" or "F"
            'age'               => 'required|numeric',
            'school_name'       => 'required|string|max:255',
            'DERECHOHABIENCIA'  => 'nullable|string|max:255',
            'fasting_status'    => 'nullable|string|max:10',  // Expected to be "SÍ" or "NO"
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

        // Use the full name (from first_name field) for PACIENTE.
        $patientName = trim($request->input('first_name'));

        // Check for duplicates based on the PACIENTE (full name) column.
        $existingPatient = Patient::where('PACIENTE', $patientName)->first();
        if ($existingPatient) {
            return redirect()->route('admin.patientUsers')
                ->with('error', 'Duplicate patient detected: ' . $patientName);
        }

        // Generate a unique CURP (using a helper method)
        $curp = $this->generateUniqueCURP();

        // Generate No_SOL: Determine the next student ID by taking the current max or default.
        $maxNoSol = Patient::max('No_SOL');
        $noSol = $maxNoSol ? $maxNoSol + 1 : 4081805;

        // Create a new patient using the patients table column names.
        Patient::create([
            // Optionally you can generate or set No_SOL and FECHA if needed.
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
            'TALLA'             => $request->input('height'),
            'IMC'               => $request->input('bmi'),
            'ICC'               => $request->input('icc'),
            'CINTURA'           => $request->input('waist'),
            'CADERA'            => $request->input('hip'),
            'COMENTARIO'        => $request->input('comments'),
        ]);

        return redirect()->route('admin.patientUsers')->with('success', 'Patient added successfully!');
    }

    // Import Patients
    public function importPatients(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);
    
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $filePath = $file->getRealPath();
    
            // Open and read the CSV file
            $fileHandle = fopen($filePath, 'r');
            $header = fgetcsv($fileHandle); // Read the header row
    
            // Expected columns for patients
            $expectedColumns = [
                'No. SOL.',
                'FECHA',
                'CURP',
                'PACIENTE',
                'SEXO',
                'EDAD',
                'ESCUELA',
                'DERECHOHABIENCIA',
                'AYUNO',
                'GLUCOSA',
                'TRIGLICÉRIDOS',
                'COLESTEROL TOTAL',
                'HBA1C',
                'PESO',
                'TALLA',
                'IMC',
                'ICC',
                'CINTURA',
                'CADERA',
                'COMENTARIO'
            ];
            if ($header !== $expectedColumns) {
                fclose($fileHandle);
                return back()->with('error', 'CSV file format is invalid. Ensure it includes: ' . implode(', ', $expectedColumns));
            }
    
            $patients = [];
            $errors = [];
    
            while (($row = fgetcsv($fileHandle)) !== false) {
                // Skip the row if it's empty or if the mandatory "No. SOL." field is blank
                if (empty(array_filter($row)) || empty(trim($row[0]))) {
                    continue;
                }
    
                // Extract numeric age (e.g., from "6 A" extract 6)
                preg_match('/\d+/', $row[5], $ageMatches);
                $age = $ageMatches[0] ?? null;
    
                $patientName = trim($row[3]);
                // Check for duplicates based on the PACIENTE (full name) column
                $existingPatient = Patient::where('PACIENTE', $patientName)->first();
                if ($existingPatient) {
                    $errors[] = "Duplicate detected for: {$patientName}";
                    continue;
                }
    
                // Validate CURP:
                // Use the provided CURP if non-empty, exactly 8 characters, and doesn’t contain "GENERAR"
                $curpRaw = trim($row[2]);
                if (!$curpRaw || strlen($curpRaw) != 8 || stripos($curpRaw, 'GENERAR') !== false) {
                    $curp = $this->generateUniqueCURP();
                } else {
                    $curp = $curpRaw;
                }
    
                // Map the AYUNO field.
                // Allowed values: "SÍ" or "NO". Try to resolve variants.
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
                Patient::insert($patients); // Bulk insert
                $successMessage = count($patients) . ' patients imported successfully!';
                if (!empty($errors)) {
                    $successMessage .= '<br>Errors: ' . implode('<br>', $errors);
                }
                return back()->with('success', $successMessage);
            } catch (\Exception $e) {
                return back()->with('error', 'Error during import: ' . $e->getMessage());
            }
        }
    }    
    /**
     * Generate a unique 8-character CURP.
     *
     * @return string
     */
    private function generateUniqueCURP(): string
    {
        do {
            $curp = Str::upper(Str::random(8));
        } while (Patient::where('CURP', $curp)->exists());

        return $curp;
    }

    // Remove Patient
    public function removePatient($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('admin.patientUsers')->with('success', 'Patient removed successfully!');
    }

    // Patient Profile View
    public function patientProfile($id)
    {
        $patient = Patient::findOrFail($id);
        return view('admin_user.users.patient_profile', compact('patient'));
    }

    // Update Patient Profile
    public function updatePatient(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('admin.users.patient_profile', $id)->with('success', 'Patient profile updated successfully!');
    }

    // Fetch Patient Measurements
    public function patientMeasurements($id)
    {
        // Fetch the patient using CURP
        $patient = Patient::where('CURP', $id)->firstOrFail();
    
        // Retrieve measurements tied to the patient via user_id
        $measurements = Measurement::where('user_id', $patient->CURP)->get();
    
        return view('admin_user.users.patient_measurements', compact('measurements', 'patient'));
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
    
        return redirect()->route('admin.users.patient_measurements', $patient->CURP)
            ->with('success', 'Measurements updated successfully and synced with patient records!');
    }
          
    // Fetch All Patient Lab Results
    public function patientLabResults($id)
    {
        // Fetch the patient using CURP
        $patient = Patient::where('CURP', $id)->firstOrFail();

        // Retrieve lab results tied to the patient via user_id
        $labResults = LabResult::where('user_id', $patient->CURP)->get();

        return view('admin_user.users.patient_labResults', compact('labResults', 'patient'));
    }

    // Upload Lab Result
    public function uploadLabResult(Request $request, $id)
    {
        // Validate upload inputs
        $request->validate([
            'lab_result'   => 'required|file|mimes:pdf,jpg,png|max:10240',
            'description'  => 'required|string|max:255',
        ]);

        // Fetch the patient using CURP
        $patient = Patient::where('CURP', $id)->firstOrFail();

        if ($request->hasFile('lab_result')) {
            $file = $request->file('lab_result');
            $filename = time() . '-' . $file->getClientOriginalName();

            // Save file directly to public/lab_results (similar to documents)
            $file->move(public_path('lab_results'), $filename);

            // Save lab result record using the correct relative path
            LabResult::create([
                'user_id'       => $patient->CURP,
                'name'          => $request->input('description'),
                'file_path'     => 'lab_results/' . $filename,  // Note the folder prefix, as in documents
                'date_assigned' => now()->toDateString(),
            ]);
        }

        return redirect()->route('admin.users.patient_labResults', $patient->CURP)
            ->with('success', 'Lab result uploaded successfully!');
    }

    // Download Lab Result
    public function downloadLabResult($id)
    {   
        $labResult = LabResult::findOrFail($id);
        // Use public_path like in documents
        $filePath = public_path($labResult->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', 'Lab result not found.');
    }    

    public function deleteLabResult($id)
    {
        // Find the lab result by ID
        $labResult = LabResult::findOrFail($id);

        // Get the file path in the public folder
        $filePath = public_path($labResult->file_path);

        // Delete the file if it exists
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the lab result record from the database
        $labResult->delete();

        return redirect()->back()->with('success', 'Lab result deleted successfully!');
    }

    // Fetch All Patient Documents
    public function allPatientDocuments($id)
    {
        // Fetch patient using CURP
        $patient = Patient::where('CURP', $id)->firstOrFail();
    
        // Retrieve documents tied to the patient via user_id
        $documents = Document::where('user_id', $patient->CURP)->get(); // Ensure user_id maps to patient ID
    
        return view('admin_user.users.patient_documents', compact('documents', 'patient'));
    }    

    // Upload Document
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
            $file->move(public_path('documents'), $filename); // Save file directly to public/documents
    
            Document::create([
                'name'      => $request->input('document_name'),
                'file_path' => 'documents/' . $filename, // Relative to the public folder
                'user_id'   => $patient->CURP,
            ]);
    
            return redirect()->route('admin.users.patient_documents', $id)
                ->with('success', 'Document uploaded successfully!');
        }
    
        return back()->with('error', 'File upload failed or no valid file provided.');
    }                           

    // Delete Document
    public function deleteDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        // Look in public folder instead of storage
        $filePath = public_path($document->file_path);
    
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    
        $document->delete();
    
        return redirect()->back()->with('success', 'Document deleted successfully!');
    }    
    
    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $filePath = public_path($document->file_path);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
    
        return redirect()->back()->with('error', 'File not found.');
    }    
}
