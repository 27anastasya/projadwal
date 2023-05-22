<?php

namespace App\Http\Controllers;

use App\Models\User;    //Model = Untuk mengekusi database
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Departements;
use App\Models\Positions;
use Illuminate\Validation\Rule;
use PDF;


class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Wrong email or password',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    // latihan tugas
    public function index()
    {
        $title = "Data User";
        $users = User::all();
        return view('users.index', compact('users', 'title'));
    }

    public function create()
    {
        $title = "Tambah Data";
        $users = User::all();
        return view('users.create', compact('users', 'title'));
       
    }

    public function store(Request $request)
    {
        // Validasi input dari formulir tambah pengguna
        $validatedData = $request->validate(['name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'position' => 'required',
            'department' => 'required',
        ]);

        // Simpan data pengguna ke dalam database
        User::create($validatedData);

        return redirect()->route('users.index')->with(
            'success',
            'User added successfully'
        );
    }

    public function edit($id)
    {
        $title = "Edit User";
        $user = User::findOrFail($id);
        return view('users.edit', compact('user', 'title'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari formulir edit pengguna
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'position' => 'required',
            'department' => 'required',
        ]);

        // Update data pengguna dalam database
        $user = User::findOrFail($id);
        $user->update($validatedData);

        return redirect()->route('users.index')->with(
            'success',
            'User updated successfully'
        );
    }

    public function destroy($id)
    {
        // Hapus data pengguna dari database
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function show($id)
    {
        $title = "Laporan User";
        $user = User::findOrFail($id);
        return view('users.show', compact('user', 'title'));
    }

    public function exportPDF()
    {
        // $users = User::all();
        // $pdf = PDF::loadView('users.pdf', compact('users'));

        // return $pdf->download('users.pdf');

        $title = "Laporan Data User";
        $users = User::orderBy('id', 'asc')->get();
        $pdf = PDF::loadview('users.pdf', compact(['users', 'title']));
        return $pdf->stream('laporan-user-pdf');
    }
}