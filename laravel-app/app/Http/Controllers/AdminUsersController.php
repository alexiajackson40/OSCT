<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Personnel;
use App\Models\Admin;
use App\Models\Measurement;
use App\Models\Document;
use App\Models\LabResult;
use Illuminate\Http\Request;

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
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:patients,username|max:255', // Insert into patients table
            'password' => 'required|string|min:5',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        // Prevent duplicates based on full name
        $existingPatient = Patient::where('first_name', $request->input('first_name'))
            ->where('last_name', $request->input('last_name'))
            ->first();

        if ($existingPatient) {
            return redirect()->route('admin.patientUsers')->with('error', 'Duplicate patient detected: ' . $request->input('first_name') . ' ' . $request->input('last_name'));
        }

        Patient::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('admin.patientUsers')->with('success', 'Patient added successfully!');
    }

    // Import Patients
    public function importPatients(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048', // Validate file type and size
        ]);

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $filePath = $file->getRealPath();

            // Open and read the CSV file
            $fileHandle = fopen($filePath, 'r');
            $header = fgetcsv($fileHandle); // Read the first row as header

            // Required columns for patients
            $expectedColumns = ['No. SOL.', 'FECHA', 'CURP', 'PACIENTE', 'SEXO', 'EDAD', 'ESCUELA', 'DERECHOHABIENCIA', 'AYUNO', 'GLUCOSA', 'TRIGLICÉRIDOS', 'COLESTEROL TOTAL', 'HBA1C', 'PESO', 'TALLA', 'IMC', 'ICC', 'CINTURA', 'CADERA', 'COMENTARIO'];
            if ($header !== $expectedColumns) {
                fclose($fileHandle);
                return back()->with('error', 'CSV file format is invalid. Ensure it includes: ' . implode(', ', $expectedColumns));
            }

            $patients = [];
            $errors = [];

            while (($row = fgetcsv($fileHandle)) !== false) {
                // Clean up the age field (e.g., "6 A" -> 6)
                preg_match('/\d+/', $row[5], $ageMatches); // Extract numeric age
                $age = $ageMatches[0] ?? null;

                // Check for duplicates based on the full name
                $existingPatient = Patient::where('first_name', $row[3])->where('last_name', $row[4])->first();

                if ($existingPatient) {
                    $errors[] = "Duplicate detected for: {$row[3]} {$row[4]}";
                    continue;
                }

                $patients[] = [
                    'first_name' => $row[3], // Full name from PACIENTE
                    'last_name' => $row[4],
                    'curp' => $row[2] ?? $this->generateCURP($row[3]),
                    'gender' => $row[5], // SEXO
                    'age' => $age,
                    'school_name' => $row[6],
                    'rights_of_coverage' => $row[7],
                    'fasting_status' => $row[8],
                    'glucose' => is_numeric($row[9]) ? $row[9] : null,
                    'triglycerides' => is_numeric($row[10]) ? $row[10] : null,
                    'total_cholesterol' => is_numeric($row[11]) ? $row[11] : null,
                    'hba1c' => is_numeric($row[12]) ? $row[12] : null,
                    'weight' => is_numeric($row[13]) ? $row[13] : null,
                    'height' => is_numeric($row[14]) ? $row[14] : null,
                    'bmi' => is_numeric($row[15]) ? $row[15] : null,
                    'icc' => is_numeric($row[16]) ? $row[16] : null,
                    'waist' => is_numeric($row[17]) ? $row[17] : null,
                    'hip' => is_numeric($row[18]) ? $row[18] : null,
                    'comments' => $row[19],
                    'role' => 'patient', // Explicitly set role as patient
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            fclose($fileHandle);

            try {
                Patient::insert($patients); // Insert into patients table

                $successMessage = count($patients) . ' patients imported successfully!';
                if (!empty($errors)) {
                    $successMessage .= '<br>Errors: ' . implode('<br>', $errors);
                }

                return back()->with('success', $successMessage);
            } catch (\Exception $e) {
                return back()->with('error', 'Error during import: ' . $e->getMessage());
            }
        }

        return back()->with('error', 'No file uploaded.');
    }

    private function generateCURP($name)
    {
        $uniquePart = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);
        $nameParts = explode(' ', $name);
        $curpBase = strtoupper(substr($nameParts[0], 0, 2)) . strtoupper(substr($nameParts[1] ?? '', 0, 2));
        return $curpBase . $uniquePart;
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
        $patient = Patient::findOrFail($id);
        $measurements = Measurement::where('user_id', $id)->get();
        return view('admin_user.users.patient_measurements', compact('measurements', 'patient'));
    }

    // Upload Measurement
    public function uploadMeasurement(Request $request, $id)
    {
        $request->validate([
            'measurement_type' => 'required|string|max:255',
            'measurement_value' => 'required|numeric',
            'measurement_date' => 'required|date',
        ]);

        Measurement::create([
            'user_id' => $id,
            'type' => $request->input('measurement_type'),
            'value' => $request->input('measurement_value'),
            'date' => $request->input('measurement_date'),
        ]);

        return redirect()->route('admin.users.patient_measurements', $id)->with('success', 'Measurement uploaded successfully!');
    }

    // Fetch All Patient Lab Results
    public function patientLabResults($id)
    {
        $patient = Patient::findOrFail($id);
        $labResults = LabResult::where('user_id', $id)->get();
        return view('admin_user.users.patient_labResults', compact('labResults', 'patient'));
    }

    // Fetch All Patient Documents
    public function allPatientDocuments($id)
    {
        $patient = Patient::findOrFail($id);
        $documents = Document::where('user_id', $id)->get();
        return view('admin_user.users.patient_documents', compact('documents', 'patient'));
    }

    // Upload Document
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_file' => 'required|file|mimes:pdf,doc,docx,png,jpg|max:10240',
        ]);

        if ($request->hasFile('document_file') && $request->file('document_file')->isValid()) {
            $file = $request->file('document_file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('public/documents', $filename);

            Document::create([
                'name' => $request->input('document_name'),
                'file_path' => 'documents/' . $filename,
            ]);

            return redirect()->route('admin.users.patient_documents')->with('success', 'Document uploaded successfully!');
        }

        return back()->with('error', 'File upload failed or no valid file provided.');
    }

    // Delete Document
    public function deleteDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $filePath = storage_path('app/public/' . $document->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $document->delete();
        return redirect()->back()->with('success', 'Document deleted successfully!');
    }
}
