<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category as CategoryModel;
use App\Models\Note as NoteModel;

class Note extends BaseController
{
    public function index()
    {
        return view('note/index', ['title' => 'My Notes', 'stats' => $this->getStats()]);
    }

    private function getStats(): array
    {
        $userId = session()->get('user_id');
        $model  = new NoteModel();

        return [
            'total'      => $model->where('user_id', $userId)->where('deleted_at IS NULL', null, false)->countAllResults(),
            'categories' => (new CategoryModel())->countAllResults(),
            'pinned'     => $model->where('user_id', $userId)->where('is_pinned', 1)->where('deleted_at IS NULL', null, false)->countAllResults(),
            'today'      => $model->where('user_id', $userId)->where('DATE(created_at)', date('Y-m-d'))->where('deleted_at IS NULL', null, false)->countAllResults(),
        ];
    }
}
