<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\User as UserModel;

class User extends Seeder
{
    public function run()
    {
        $model = new UserModel();

        $model->insert([
            'name'          => 'Admin',
            'email'         => 'admin@notespace.dev',
            'password_hash' => password_hash('password', PASSWORD_BCRYPT),
        ]);
    }
}
