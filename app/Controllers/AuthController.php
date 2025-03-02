<?php
namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController {
    public function register() {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|min_length[3]|is_unique[users.username]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]'
            ];
            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $userModel->save([
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
                ]);
                return redirect()->to('/login')->with('message', 'Registration successful!');
            }
            return view('auth/register', ['validation' => $this->validator]);
        }
        return view('auth/register');
    }

    public function login() {
        if ($this->request->getMethod() === 'post') {
            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getPost('email'))->first();
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                session()->set(['user_id' => $user['id'], 'username' => $user['username']]);
                return redirect()->to('/tests');
            }
            return view('auth/login', ['error' => 'Invalid credentials']);
        }
        return view('auth/login');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}