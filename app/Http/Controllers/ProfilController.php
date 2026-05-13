<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function admin()
    {
        $user = auth()->user();

        return view('profil.admin', compact('user'));
    }

    public function panitia()
    {
        $user = auth()->user(); // Mendapatkan user yang sedang login
        $panitia = $user->panitia; // Mendapatkan data panitia dari user yang sedang login

        return view('profil.panitia', compact('panitia'));
    }

    public function casis()
    {
        $user = auth()->user(); // Mendapatkan user yang sedang login
        $casis = $user->casis; // Mendapatkan data calon siswa (casis) dari user yang sedang login

        return view('profil.casis', compact('casis','user'));
    }
}
