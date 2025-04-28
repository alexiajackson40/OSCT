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
            ->with('success', '¡Medidas actualizadas exitosamente y sincronizadas con los registros del paciente!');
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
    
        return redirect()->route('personnel.patientProfile', $id)->with('success', '¡Perfil del paciente actualizado exitosamente!');
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
