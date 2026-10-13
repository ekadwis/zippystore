<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PengaturanModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to(site_url('admin/sosmed'));
        }
        return view('auth/login', [
            'title'      => 'Login - Zippy Store',
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ]);
    }

    public function attemptLogin()
    {
        $input    = trim((string) $this->request->getPost('email')); // field form bernama 'email'
        $password = (string) $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin      = $adminModel->findByUsername($input);

        // Jika user memasukkan email toko, tetap izinkan login
        if (! $admin) {
            $set = (new PengaturanModel())->getSettings();
            if (! empty($set['email']) && strtolower($input) === strtolower($set['email'])) {
                $admin = $adminModel->first();
            }
        }

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'admin_logged_in' => true,
                'admin_id'        => $admin['id'],
                'admin_username'  => $admin['username'],
            ]);
            return redirect()->to(site_url('admin/sosmed'));
        }

        return redirect()->to(site_url('login'))->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}