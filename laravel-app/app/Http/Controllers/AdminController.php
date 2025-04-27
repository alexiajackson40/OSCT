<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Personnel;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin_user.home');
    }

    public function profile()
    {
        $user = Auth::guard('admin')->user();
    
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in to access this page.');
        }
    
        return view('admin_user.profile', compact('user'));
    }
    
    public function storeUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username|max:255',
            'role' => 'required|in:admin,personnel,patient',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        // Handle creating the user based on role
        if ($request->input('role') === 'admin') {
            Admin::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'role' => 'admin'
            ]);
        } elseif ($request->input('role') === 'personnel') {
            Personnel::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'role' => 'personnel'
            ]);
        } else {
            Patient::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);
        }
    
        if ($request->input('role') === 'admin') {
            return redirect()->route('admin.adminUsers')->with('success', 'Admin added successfully!');
        } elseif ($request->input('role') === 'personnel') {
            return redirect()->route('admin.personnelUsers')->with('success', 'Personnel added successfully!');
        } else {
            return redirect()->route('admin.patientUsers')->with('success', 'Patient added successfully!');
        }
        
    }

    public function editProfile()
    {
        $user = Auth::guard('admin')->user();
    
        return view('admin_user.edit_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . Auth::guard('admin')->id(),
            'email' => 'required|email|max:255|unique:admins,email,' . Auth::guard('admin')->id(),
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);
    
        $user = Auth::guard('admin')->user();
    
        // Update the user in the database
        $updated = $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
    
        // Check if the update was successful
        if ($updated) {
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
        }
    
        // If the update failed, stay on the edit page with an error message
        return redirect()->back()->withErrors('Failed to update profile. Please try again.');
    }

    public function destroyUser($id)
    {
        $admin = \App\Models\Admin::find($id);
        $personnel = \App\Models\Personnel::find($id);
    
        if ($admin) {
            $admin->delete();
            return redirect()->route('admin.users')->with('success', 'Admin deleted successfully.');
        } elseif ($personnel) {
            $personnel->delete();
            return redirect()->route('admin.users')->with('success', 'Personnel deleted successfully.');
        }
    
        return redirect()->route('admin.users')->with('error', 'User not found.');
    }
    
    public function headerAdmin()
    {
        return view('admin_user.header_admin');
    }

    public function schedule()
    {
        $schedules = Schedule::all(); // Retrieve all schedules
        return view('admin_user.schedule', compact('schedules'));
    }
    
    public function uploadSchedule(Request $request)
    {
        $request->validate([
            'schedule_file' => 'required|mimes:csv,txt|max:2048', // Validate file type and size
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
    
            // Ensure the header matches or contains at least the expected columns
            $truncatedHeader = array_slice($header, 0, count($expectedColumns));
    
            if ($truncatedHeader !== $expectedColumns) {
                fclose($fileHandle);
                \Log::error('CSV header does not match expected format.', [
                    'expected' => $expectedColumns,
                    'actual' => $header,
                ]);
                return back()->with('error', 'Invalid CSV format. Ensure headers match: ' . implode(', ', $expectedColumns));
            }
    
            $schedules = [];
            $errors = [];
            $rowIndex = 1;
    
            while (($row = fgetcsv($fileHandle)) !== false) {
                $rowIndex++;
                \Log::info("Processing row $rowIndex:", $row);
    
                // Truncate the row to match the expected columns
                $row = array_slice($row, 0, count($expectedColumns));
                \Log::info("Truncated row $rowIndex:", $row);
    
                if (empty(array_filter($row)) || count($row) !== count($expectedColumns)) {
                    $errors[] = "Invalid row at index $rowIndex. Skipping.";
                    \Log::warning("Row $rowIndex skipped due to empty or mismatched columns.", $row);
                    continue;
                }
    
                $rowData = @array_combine($expectedColumns, $row);
                if (!$rowData) {
                    $errors[] = "Row at index $rowIndex could not be processed. Skipping.";
                    \Log::warning("Row $rowIndex could not be processed. Data:", $row);
                    continue;
                }
    
                // Debug: Log raw FECHA value
                $fechaRaw = trim($rowData['FECHA']);
                \Log::info("Raw FECHA value for row $rowIndex: '$fechaRaw'");
    
                // Sanitize FECHA column
                $fechaCleaned = preg_replace('/^[A-ZÁÉÍÓÚÑ]+\s+/u', '', $fechaRaw); // Remove weekday
                $fechaCleaned = preg_replace('/\s+/', '', $fechaCleaned); // Remove any remaining spaces
                \Log::info("Sanitized FECHA value for row $rowIndex: '$fechaCleaned'");
    
                try {
                    // Parse date assuming format d/m/y
                    $date = \Carbon\Carbon::createFromFormat('d/m/y', $fechaCleaned)->format('Y-m-d');
                    \Log::info("Parsed date for row $rowIndex: '$fechaCleaned' → '$date'");
                } catch (\Exception $e) {
                    $errors[] = "Invalid date format at row $rowIndex: '$fechaRaw'. Skipping.";
                    \Log::error("Date parsing error for row $rowIndex: '$fechaRaw' → '$fechaCleaned'", ['error' => $e->getMessage()]);
                    continue;
                }
    
                $schedules[] = [
                    'level'           => $rowData['NIVEL'],
                    'shift'           => $rowData['TURNO'],
                    'cct'             => $rowData['CCT'],
                    'school_name'     => $rowData['NOMBRE DE LA ESCUELA'],
                    'municipality'    => $rowData['MUNICIPIO'],
                    'locality'        => $rowData['LOCALIDAD'],
                    'address'         => $rowData['DOMICILIO'],
                    'total_students'  => is_numeric($rowData['TOTAL DE ALUMNOS']) ? (int) $rowData['TOTAL DE ALUMNOS'] : null,
                    'date'            => $date,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ];
            }
    
            fclose($fileHandle);
    
            \Log::info('Finished reading CSV file. Preparing for database insertion.');
    
            try {
                if (!empty($schedules)) {
                    \DB::table('schedule')->insert($schedules);
                    \Log::info(count($schedules) . ' schedules inserted successfully.');
                }
    
                $successMessage = count($schedules) . ' schedules uploaded successfully.';
                if (!empty($errors)) {
                    $successMessage .= '<br>Some errors occurred:<br>' . implode('<br>', $errors);
                }
    
                return back()->with('success', $successMessage);
            } catch (\Exception $e) {
                \Log::error('Database insertion error', ['error' => $e->getMessage()]);
                return back()->with('error', 'Upload failed: ' . $e->getMessage());
            }
        }
    
        \Log::error('No file uploaded.');
        return back()->with('error', 'No file uploaded.');
    }
    
    public function scheduleEdit($id) {
        $schedule = Schedule::findOrFail($id);
        return view('admin_user.edit_schedule', compact('schedule'));
    }
    
    public function scheduleUpdate(Request $request, $id)
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
    
        return redirect()->route('schedule.index')->with('success', 'Schedule updated!');
    }         

    public function users()
    {
        $admins = Admin::all(); // Fetch admins
        $personnel = Personnel::all(); // Fetch personnel
        //$patients = Patient::all(); // Fetch patients
    
        // Combine all user types into one collection
        $users = $admins->concat($personnel);
    
        return view('admin_user.users', compact('users'));
    }    

    public function addUser()
    {
        return view('admin_user.add_user');
    }

    public function editUser($id)
    {
        $user = Admin::find($id) ?? Personnel::find($id) ?? Patient::find($id); // Fetch user by ID
    
        if (!$user) {
            return redirect()->route('admin.users')->withErrors('User not found.');
        }
    
        return view('admin_user.edit_user', compact('user'));
    }
    
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string|max:15',
        ]);
    
        $user = Admin::find($id) ?? Personnel::find($id);
    
        if (!$user) {
            return redirect()->route('admin.users')->withErrors('User not found.');
        }
    
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
    
        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function changePasswordForm()
    {
        $user = Auth::guard('admin')->user();
        return view('admin_user.change_password', compact('user'));
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
    
        $user = Auth::guard('admin')->user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
    
        $user->password = $request->new_password;
        $user->save();
    
        return redirect()->route('admin.profile')->with('success', 'Password updated successfully.');
    }
    
}
