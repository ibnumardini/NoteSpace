<?= $this->extend('layouts/note') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.7/quill.snow.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="mb-4">
  <a href="/" class="btn-back">
    <img src="/assets/svg/arrow-left.svg" width="16" height="16" alt="" />
    Back
  </a>
</div>

<h1 class="note-form-title mb-4">New Note</h1>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger mb-3">
    <ul class="mb-0 px-3">
      <?php foreach ($errors as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif ?>

<form method="POST" action="/create">
  <?= csrf_field() ?>

  <div class="mb-3">
    <label for="noteTitle" class="form-label">Title</label>
    <input type="text" id="noteTitle" name="title" class="form-control" placeholder="Give your note a title…" required maxlength="255" value="<?= esc($old['title'] ?? '') ?>" />
  </div>

  <div class="mb-3">
    <label for="noteCategory" class="form-label">Category</label>
    <select id="noteCategory" name="category" class="form-select">
      <option value="" disabled selected>Select a category</option>
      <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>" <?= isset($old['category']) && $old['category'] == $category['id'] ? 'selected' : '' ?>>
          <?= esc($category['name']) ?>
        </option>
      <?php endforeach ?>
    </select>
  </div>

  <div class="mb-4">
    <label class="form-label">Content</label>
    <div class="quill-wrap">
      <div id="quillEditor" style="min-height: 200px;"></div>
    </div>
    <input type="hidden" name="content" id="noteContent" />
  </div>

  <div class="d-flex justify-content-end gap-2">
    <a href="/" class="btn-modal-cancel">Cancel</a>
    <button type="submit" class="btn-modal-save">Save Note</button>
  </div>

</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script src="/assets/js/editor.js"></script>
<?= $this->endSection() ?>
