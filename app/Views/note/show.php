<?= $this->extend('layouts/note') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
  <a href="<?= $back ?>" class="btn-back">
    <img src="/assets/svg/arrow-left.svg" width="16" height="16" alt="" />
    Back
  </a>
  <div class="d-flex align-items-center gap-2">
    <?php if ($back === '/'): ?>
      <a href="/<?= $note['id'] ?>/edit?back=<?= urlencode($back) ?>" class="btn-modal-save">Edit</a>
      <form method="POST" action="/<?= $note['id'] ?>/archive" style="display:contents">
        <?= csrf_field() ?>
        <button type="submit" class="btn-modal-cancel">Archive</button>
      </form>
    <?php endif ?>
  </div>
</div>

<div class="mb-4">
  <h1 class="note-detail-title"><?= esc($note['title']) ?></h1>
  <div class="d-flex align-items-center gap-2">
    <?php if ($category): ?>
      <span class="badge-category badge-<?= esc($category['slug'] ?? '') ?>"><?= esc($category['name']) ?></span>
    <?php endif ?>
    <span class="note-date"><?= $date ?></span>
  </div>
</div>

<div class="note-detail-body">
  <?= $note['content'] ?>
</div>

<?= $this->endSection() ?>
