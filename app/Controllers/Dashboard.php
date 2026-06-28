<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $title = 'Dashboard';

        return view('dashboard/index', compact('title'));
    }
}
