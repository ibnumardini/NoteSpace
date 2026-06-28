<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Note extends BaseController
{
    public function index()
    {
        $title = 'My Notes';

        return view('note/index', compact('title'));
    }
}
