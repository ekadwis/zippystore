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
        $username = $this->request->getPost('email'); // field form bernama 'email'
        $password = $this->request->getPost('password');

        $admin = (new AdminModel())->findByUsername($username);

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