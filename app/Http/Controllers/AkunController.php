<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AkunController extends Controller
{
    public function index()
    {
        return view('akun.index');
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $rules = [
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'email'    => 'required|email|max:255|unique:admins,email,' . $admin->id,
        ];

        // Validasi password hanya jika diisi
        if ($request->filled('password')) {
            $rules['password_lama']     = 'required|string';
            $rules['password']          = 'required|string|min:8|confirmed';
            $rules['password_confirmation'] = 'required|string';
        }

        $request->validate($rules, [
            'username.required'      => 'Username wajib diisi.',
            'username.unique'        => 'Username sudah digunakan.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email sudah digunakan.',
            'password_lama.required' => 'Password lama wajib diisi jika ingin mengubah password.',
            'password.min'           => 'Password baru minimal 8 karakter.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
        ]);

        // Cek password lama jika user ingin ganti password
        if ($request->filled('password')) {
            if (!Hash::check($request->password_lama, $admin->password)) {
                return back()->withErrors(['password_lama' => 'Password lama salah.'])->withInput();
            }
        }

        $admin->username = $request->username;
        $admin->email    = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return back()->with('success', 'Pengaturan akun berhasil disimpan.');
    }
}
