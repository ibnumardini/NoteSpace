<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category as CategoryModel;
use App\Models\Note as NoteModel;

class Note extends BaseController
{
    public function index()
    {
        helper('text');
        $categories     = (new CategoryModel())->findAll();
        $activeCategory = $this->request->getGet('category');
        $search         = $this->request->getGet('q');

        return view('note/index', [
            'title'          => 'My Notes',
            'stats'          => $this->getStats(),
            'categories'     => $categories,
            'activeCategory' => $activeCategory,
            'search'         => $search,
            'notes'          => $this->getNotes($activeCategory, $search, $categories),
        ]);
    }

    public function archived()
    {
        helper('text');
        $categories     = (new CategoryModel())->findAll();
        $activeCategory = $this->request->getGet('category');
        $search         = $this->request->getGet('q');

        return view('note/archived', [
            'title'          => 'Archived',
            'categories'     => $categories,
            'activeCategory' => $activeCategory,
            'search'         => $search,
            'notes'          => $this->getNotes($activeCategory, $search, $categories, 'archived'),
        ]);
    }

    public function create()
    {
        $categories = (new CategoryModel())->findAll();
        return view('note/create', ['title' => 'New Note', 'categories' => $categories]);
    }

    public function store()
    {
        $rules = [
            'title'    => 'required|max_length[255]',
            'category' => 'required|is_natural_no_zero',
        ];

        $categories = (new CategoryModel())->findAll();

        if (!$this->validate($rules)) {
            return view('note/create', [
                'title'      => 'New Note',
                'categories' => $categories,
                'errors'     => $this->validator->getErrors(),
                'old'        => $this->request->getPost(),
            ]);
        }

        (new NoteModel())->insert([
            'title'       => $this->request->getPost('title'),
            'content'     => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category'),
            'user_id'     => session()->get('user_id'),
            'status'      => 'active',
            'is_pinned'   => 0,
        ]);

        return redirect()->to('/');
    }

    public function show(int $id)
    {
        $model = new NoteModel();
        $note  = $model->where('user_id', session()->get('user_id'))->find($id);

        if (!$note) {
            return redirect()->to('/');
        }

        $cat = (new CategoryModel())->find($note['category_id']);

        $back = str_contains(previous_url(), '/archived') ? '/archived' : '/';

        return view('note/show', [
            'title'    => $note['title'],
            'note'     => $note,
            'category' => $cat,
            'date'     => date('M j, Y', strtotime($note['updated_at'])),
            'back'     => $back,
        ]);
    }

    public function archive(int $id)
    {
        $model = new NoteModel();
        $note  = $model->where('user_id', session()->get('user_id'))->find($id);

        if ($note) {
            $model->update($id, ['status' => 'archived']);
        }

        $from = str_contains(previous_url(), "/{$id}") ? '/archived' : '/';

        return redirect()->to($from);
    }

    public function edit(int $id)
    {
        $model = new NoteModel();
        $note  = $model->where('user_id', session()->get('user_id'))->find($id);

        if (!$note) {
            return redirect()->to('/');
        }

        return view('note/edit', [
            'title'      => 'Edit Note',
            'note'       => $note,
            'categories' => (new CategoryModel())->findAll(),
        ]);
    }

    public function update(int $id)
    {
        $model = new NoteModel();
        $note  = $model->where('user_id', session()->get('user_id'))->find($id);

        if (!$note) {
            return redirect()->to('/');
        }

        $rules = [
            'title'    => 'required|max_length[255]',
            'category' => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            return view('note/edit', [
                'title'      => 'Edit Note',
                'note'       => $note,
                'categories' => (new CategoryModel())->findAll(),
                'errors'     => $this->validator->getErrors(),
            ]);
        }

        $model->update($id, [
            'title'       => $this->request->getPost('title'),
            'content'     => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category'),
        ]);

        return redirect()->to('/');
    }

    public function trash()
    {
        helper('text');
        $categories = (new CategoryModel())->findAll();

        $notes = (new NoteModel())
            ->where('user_id', session()->get('user_id'))
            ->where('deleted_at IS NOT NULL', null, false)
            ->orderBy('deleted_at', 'DESC')
            ->withDeleted()
            ->findAll();

        $notes = array_map(function ($note) use ($categories) {
            $cat = array_filter($categories, fn($c) => $c['id'] === $note['category_id']);
            $note['category'] = reset($cat) ?: null;
            $plain = html_entity_decode(strip_tags($note['content'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $note['snippet'] = mb_strlen($plain) > 100 ? mb_substr($plain, 0, 100) . '...' : $plain;
            $note['date']     = date('M j, Y', strtotime($note['deleted_at']));
            return $note;
        }, $notes);

        return view('note/trash', ['title' => 'Trash', 'notes' => $notes]);
    }

    private function getNotes(?string $activeCategory, ?string $search, array $categories, string $status = 'active'): array
    {
        $model = new NoteModel();
        $model->where('user_id', session()->get('user_id'))
            ->where('status', $status)
            ->where('deleted_at IS NULL', null, false)
            ->orderBy('is_pinned', 'DESC')
            ->orderBy('updated_at', 'DESC');

        if ($search) {
            $model->groupStart()
                ->like('title', $search)
                ->orLike('content', $search)
                ->groupEnd();
        }

        if ($activeCategory) {
            $filtered = array_filter($categories, fn($c) => $c['slug'] === $activeCategory);
            $cat      = reset($filtered);
            if ($cat) {
                $model->where('category_id', $cat['id']);
            }
        }

        return array_map(function ($note) use ($categories) {
            $cat = array_filter($categories, fn($c) => $c['id'] === $note['category_id']);
            $note['category'] = reset($cat) ?: null;
            $plain = html_entity_decode(strip_tags($note['content'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $note['snippet'] = mb_strlen($plain) > 100 ? mb_substr($plain, 0, 100) . '...' : $plain;
            $note['date']     = date('M j, Y', strtotime($note['updated_at']));
            return $note;
        }, $model->findAll());
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
