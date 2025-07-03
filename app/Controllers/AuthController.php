<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $userModel = new UserModel();
        $mahasiswaModel = new MahasiswaModel();
        $dosenModel = new DosenModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan!');
        }

        $mahasiswa = $mahasiswaModel->where('user_id', $user['id'])->first();
        $dosen = $dosenModel->where('user_id', $user['id'])->first();

        if (($mahasiswa || $dosen || $user['role'] == 'admin') && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'logged_in' => true,
            ]);

            return redirect()->to('/dashboard')->with('success', 'Selamat datang ' . ($mahasiswa ? $mahasiswa['nama'] : ($dosen ? $dosen['nama'] : $user['username'])));
        }

        return redirect()->back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

