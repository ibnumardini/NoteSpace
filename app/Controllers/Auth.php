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

        $this->loginUser($user);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }

    public function googleLogin()
    {
        $clientId = env('google_client_id');
        $redirectUri = base_url('/auth/google/callback');
        $scope = 'email profile';

        $url = 'https://accounts.google.com/o/oauth2/v2/auth'
            . '?client_id=' . urlencode($clientId)
            . '&redirect_uri=' . urlencode($redirectUri)
            . '&response_type=code'
            . '&scope=' . urlencode($scope)
            . '&access_type=offline';

        return redirect()->to($url);
    }

    public function googleCallback()
    {
        $code = $this->request->getGet('code');
        if (!$code) {
            return redirect()->to('/auth/login')->with('error', 'Google login failed.');
        }

        $clientId     = env('google_client_id');
        $clientSecret = env('google_client_secret');
        $redirectUri  = base_url('/auth/google/callback');

        $response = \Config\Services::curlrequest()->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'code'          => $code,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri'  => $redirectUri,
                'grant_type'    => 'authorization_code',
            ],
        ]);
        $tokenResponse = json_decode($response->getBody(), true) ?: [];

        if (empty($tokenResponse['id_token'])) {
            return redirect()->to('/auth/login')->with('error', 'Google login failed.');
        }

        $payload = $this->decodeJwtPayload($tokenResponse['id_token']);
        if (!$payload || empty($payload['sub'])) {
            return redirect()->to('/auth/login')->with('error', 'Google login failed.');
        }

        $googleId = $payload['sub'];
        $email    = $payload['email'] ?? '';
        $name     = $payload['name'] ?? $email;

        $model = new User();
        $user  = $model->where('google_id', $googleId)->first();

        if (!$user) {
            $existing = $model->where('email', $email)->first();
            if ($existing) {
                $model->update($existing['id'], ['google_id' => $googleId]);
                $user = $model->find($existing['id']);
            } else {
                $userId = $model->insert([
                    'name'      => $name,
                    'email'     => $email,
                    'google_id' => $googleId,
                ]);
                $user = $model->find($userId);
            }
        }

        $this->loginUser($user);

        return redirect()->to('/');
    }

    private function loginUser(array $user): void
    {
        session()->set([
            'user_id'    => $user['id'],
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
            'logged_in'  => true,
        ]);
    }

    private function decodeJwtPayload(string $jwt): ?array
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return null;
        }
        $payload = base64_decode(strtr($parts[1], '-_', '+/'), true);
        return json_decode($payload, true);
    }
}
