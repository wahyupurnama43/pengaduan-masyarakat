<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\registerUpdateRequest;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {

        $pengaduan = Auth::user()->role == 'masyarakat' ? Pengaduan::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get() : Pengaduan::orderBy('created_at', 'desc')->get();
        return view('pages.dashboard', compact('pengaduan'));
    }

    public function akun()
    {
        $user = User::all();
        return view('pages.akun', compact('user'));
    }

    public function storeUser(RegisterRequest $registerRequest)
    {
        $email = $registerRequest->email;
        $password = $registerRequest->password;
        $nama = $registerRequest->nama;
        $role = $registerRequest->role;

        $user = new User();
        $user->email = $email;
        $user->nama = $nama;
        $user->role = $role;
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('dashboard.akun')->with('success', 'User Telah Ditambahkan');
    }

    public function updateUser(registerUpdateRequest $registerUpdateRequest, $id)
    {
        $email = $registerUpdateRequest->email;
        $nama = $registerUpdateRequest->nama;
        $role = $registerUpdateRequest->role;

        $user = User::findOrFail($id);
        $user->email = $email;
        $user->nama = $nama;
        $user->role = $role;
        $user->password = !is_null($registerUpdateRequest->password) ? Hash::make($registerUpdateRequest->password) : $user->password;
        $user->save();

        return redirect()->route('dashboard.akun')->with('success', 'User Telah Diubah');
    }

    public function deteleUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('dashboard.akun')->with('success', 'User Telah Dihapus');
    }
}
