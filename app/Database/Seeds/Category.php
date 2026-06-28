<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Category as CategoryModel;

class Category extends Seeder
{
    public function run()
    {
        $model = new CategoryModel();

        $model->insertBatch([
            ['name' => 'Personal'],
            ['name' => 'Work'],
            ['name' => 'Ideas'],
            ['name' => 'To-Do'],
        ]);
    }
}
