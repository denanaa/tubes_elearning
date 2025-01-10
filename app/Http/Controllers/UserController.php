<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('data-user', compact('users'));
    }

    public function create()
    {
        return view('create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password), // Hash password
        ]);
        return redirect()->route('data-user')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('data-user')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('data-user')->with('success', 'User deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); // Ambil query dari input form
    
        // Cek jika query tidak kosong
        if ($query) {
            $users = User::where('name', 'like', "%{$query}%") // Cari nama yang mengandung query
                         ->orWhere('email', 'like', "%{$query}%")
                         ->paginate(10); // Gunakan pagination
        } else {
            $users = User::paginate(10); // Jika tidak ada query, tampilkan semua user
        }
    
        // Kembalikan view dengan hasil pencarian
        return view('data-user', compact('users', 'query'));
    }
    

    public function liveSearch(Request $request)
    {
        $query = $request->input('query'); // Ambil query dari input AJAX
    
        // Cari nama atau email yang mengandung query
        if ($query) {
            $users = User::where('name', 'like', "%{$query}%")
                         ->orWhere('email', 'like', "%{$query}%")
                         ->get(); // Ambil semua hasil tanpa pagination
        } else {
            $users = []; // Jika query kosong, kembalikan array kosong
        }
    
        // Kembalikan hasil dalam format JSON
        return response()->json($users);
    }    

    public function loadAllUsers()
    {
    $users = User::all(); // Ambil semua data pengguna
    return response()->json($users);
    }

    

public function generatePDF()
{
    $users = User::all(); // Ambil data user
    $pdf = Pdf::loadView('pdf-users', compact('users'));
    return $pdf->download('data_users.pdf');
}



}
