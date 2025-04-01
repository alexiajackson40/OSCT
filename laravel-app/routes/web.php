use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PersonnelController;

Route::get('/', fn () => view('home'));

Route::prefix('admin')->group(function () {
    Route::get('home', [AdminController::class, 'home']);
    Route::get('profile', [AdminController::class, 'profile']);
    Route::get('schedule', [AdminController::class, 'schedule']);
    Route::get('users', [AdminController::class, 'users']);
    Route::get('add-user', [AdminController::class, 'addUser']);

    // Admin > Users
    Route::get('users/patient', [AdminUsersController::class, 'patientUsers']);
    Route::get('users/patient/profile/{id}', [AdminUsersController::class, 'patientProfile']);
    Route::get('users/patient/measurements', [AdminUsersController::class, 'patientMeasurements']);
    Route::get('users/patient/documents', [AdminUsersController::class, 'patientDocuments']);
    Route::get('users/patient/lab-results', [AdminUsersController::class, 'patientLabResults']);

    Route::get('users/personnel', [AdminUsersController::class, 'personnelUsers']);
    Route::get('users/personnel/profile/{id}', [AdminUsersController::class, 'personnelProfile']);

    Route::get('users/admin', [AdminUsersController::class, 'adminUsers']);
    Route::get('users/admin/profile/{id}', [AdminUsersController::class, 'adminProfile']);
});
