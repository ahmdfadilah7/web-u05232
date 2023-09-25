<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        $setting = Setting::first();
        
        return view('sistem.auth.login', compact('setting'));
    }

    // Proses Logout
    public function logout()
    {
        if (Auth::guard('websistem')->check()) {
            Auth::guard('websistem')->logout();
        }
        return redirect()->route('sistem.login')->with('success', 'Berhasil keluar.');
    }

    // Proses Login
    public function proses_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $username = $request->get('username');
        $password = Hash::make($request->get('password'));
        if (Auth::guard('websistem')->attempt($request->only('username', 'password'))) {
            return redirect()->route('sistem.dashboard')->with('success', 'Berhasil login');
        } else {
            return back()->with('danger', 'Data yang dimasukkan tidak sesuai.');
        }

    }
}
