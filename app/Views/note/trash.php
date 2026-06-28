<?= $this->extend('layouts/note') ?>
<?= $this->section('content') ?>

<div class="page-header">
  <h1 class="page-title">Trash</h1>
  <p class="page-subtitle">Notes moved to trash.</p>
</div>

<div class="row g-3">

  <?php if (empty($notes)): ?>
    <div class="col-12 fs-7">
      <p class="text-muted text-center py-4">Trash is empty.</p>
    </div>
  <?php else: ?>
    <div class="col-12 d-flex justify-content-end mb-1">
      <button class="btn-new-note">Delete All</button>
    </div>
    <?php foreach ($notes as $note): ?>
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="note-card">
          <div class="note-card-header">
            <h3 class="note-card-title"><?= esc($note['title']) ?></h3>
            <div class="note-actions">
              <form method="POST" action="/<?= $note['id'] ?>/restore" style="display:contents">
                <?= csrf_field() ?>
                <button type="submit" class="note-action-btn edit" title="Restore" aria-label="Restore note">
                  <img src="/assets/svg/restore.svg" width="14" height="14" alt="" />
                </button>
              </form>
              <button class="note-action-btn delete" title="Delete permanently" aria-label="Delete permanently">
                <img src="/assets/svg/trash.svg" width="14" height="14" alt="" />
              </button>
            </div>
          </div>
          <?php if ($note['snippet']): ?>
            <p class="note-card-snippet"><?= esc($note['snippet']) ?></p>
          <?php endif ?>
          <div class="note-card-footer">
            <span class="note-date"><?= $note['date'] ?></span>
            <?php if ($note['category']): ?>
              <span class="badge-category badge-<?= $note['category']['slug'] ?>"><?= esc($note['category']['name']) ?></span>
            <?php endif ?>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  <?php endif ?>

</div>

<?= $this->endSection() ?>
