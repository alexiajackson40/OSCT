namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    // Show the add user form
    public function create()
    {
        return view('add_user');
    }

    // Store the new user data
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // Include password validation
            'agree_terms' => 'accepted', // Ensure terms are accepted
        ]);

        // Create a new user using validated data
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'student_id' => $validated['student_id'],
            'phone' => $validated['phone_number'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']), // Encrypt the password
        ]);

        // Redirect back to the form with a success message
        return redirect()->route('add-user.create')->with('success', 'User created successfully!');
    }
}
