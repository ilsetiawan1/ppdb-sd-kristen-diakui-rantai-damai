<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tahunajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function registrasi(Request $request)
    {
        if ($request->input('captcha_failed')) {
            // Captcha gagal, kirim pesan kesalahan ke sisi klien
            return response()->json([
                'message' => 'Verifikasi Captcha gagal. Silakan coba lagi.'
            ]);
        }

        $tahunAjarBerlangsung = tahunajar::where('status', 'Berlangsung')->first();

        if (!$tahunAjarBerlangsung) {
            // Jika tidak ada tahun ajaran yang berlangsung, kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Pendaftaran Siswa Baru Telah Ditutup');
        }

        // Jika ada tahun ajaran yang berlangsung, lanjutkan proses registrasi
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'Calon Siswa',
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil!');
    }

    public function loginproses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|numeric',
        ]);

        $validator->after(function ($validator) use ($request) {
            $num1 = intval($request->input('num1'));
            $num2 = intval($request->input('num2'));
            $captcha = intval($request->input('captcha'));

            if ($captcha !== ($num1 + $num2)) {
                $validator->errors()->add('captcha', 'Jawaban Captcha salah. Silakan coba lagi.');
            }
        });

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = [];

            if ($errors->has('email')) {
                $errorMessages[] = 'Email tidak valid.';
            }
            if ($errors->has('password')) {
                $errorMessages[] = 'Password harus diisi.';
            }
            if ($errors->has('captcha')) {
                $errorMessages[] = $errors->first('captcha');
            }

            $errorMessage = implode(' ', $errorMessages);

            return redirect('/')
                ->withErrors($validator)
                ->withInput($request->except('password'))
                ->with('error', $errorMessage ?: 'Mohon isi semua field dengan benar.');
        }

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Store user object in session
            $request->session()->put('user', $user);

            // Redirect based on user role
            switch ($user->role) {
                case 'Admin':
                case 'Kepala Sekolah':
                    return redirect('/admin/dashboard')->with('success', 'Selamat datang, ' . $user->name);
                case 'Panitia':
                    return redirect('/beranda/panitia')->with('success', 'Selamat datang, ' . $user->name);
                case 'Calon Siswa':
                    return redirect('/beranda/casis')->with('success', 'Selamat datang, ' . $user->name);
                default:
                    Auth::logout();
                    return redirect('/')->with('error', 'Akses ditolak. Hubungi administrator untuk informasi lebih lanjut.');
            }
        }

        // Login failed
        return redirect('/')
            ->withInput($request->except('password'))
            ->with('error', 'Email atau password salah. Silakan coba lagi.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
