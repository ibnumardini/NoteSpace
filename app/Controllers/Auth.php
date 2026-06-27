<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register', ['title' => 'Sign Up']);
    }

    public function registerPost()
    {
        $rules = [
            'name'                  => 'required|min_length[2]',
            'email'                 => 'required|valid_email|is_unique[users.email]',
            'password'              => 'required|min_length[8]',
            'password_confirmation' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'title'  => 'Sign Up',
                'errors' => $this->validator->getErrors(),
                'old'    => $this->request->getPost(),
            ]);
        }

        $model = new User();
        $model->insert([
            'name'          => $this->request->getPost('name'),
            'email'         => strtolower($this->request->getPost('email')),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ]);

        return redirect()->to('/auth/login')->with('success', 'Account created. Please sign in.');
    }

    public function login()
    {
        return view('auth/login', ['title' => 'Sign In']);
    }

    public function loginPost()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('auth/login', [
                'title'  => 'Sign In',
                'errors' => $this->validator->getErrors(),
                'old'    => $this->request->getPost(),
            ]);
        }

        $model = new User();
        $user  = $model->where('email', strtolower($this->request->getPost('email')))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password_hash'])) {
            return view('auth/login', [
                'title'  => 'Sign In',
                'errors' => ['auth' => 'Invalid email or password.'],
                'old'    => $this->request->getPost(),
            ]);
        }

        $session = session();
        $session->set([
            'user_id'    => $user['id'],
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
            'logged_in'  => true,
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
