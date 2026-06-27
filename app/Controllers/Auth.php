<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
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
}
