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

    private function getNotes(?string $activeCategory, ?string $search, array $categories): array
    {
        $model = new NoteModel();
        $model->where('user_id', session()->get('user_id'))
              ->where('status', 'active')
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
            $note['snippet']  = character_limiter(strip_tags($note['content'] ?? ''), 100);
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
