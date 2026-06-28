<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Note as NoteModel;
use App\Models\User as UserModel;
use App\Models\Category as CategoryModel;

class Note extends Seeder
{
    public function run()
    {
        $user     = (new UserModel())->where('email', 'admin@notespace.dev')->first();
        $category = (new CategoryModel())->where('name', 'Personal')->first();

        (new NoteModel())->insert([
            'title'       => 'Welcome to NoteSpace',
            'content'     => 'This is your first note. Start capturing your ideas!',
            'is_pinned'   => true,
            'category_id' => $category['id'],
            'status'      => 'active',
            'user_id'     => $user['id'],
        ]);
    }
}
