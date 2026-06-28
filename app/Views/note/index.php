<?= $this->extend('layouts/note') ?>
<?= $this->section('content') ?>

<div class="page-header">
  <h1 class="page-title">My Notes</h1>
  <p class="page-subtitle">All your thoughts, captured.</p>
</div>

<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-icon lime">
        <img src="/assets/svg/stat-notes.svg" width="20" height="20" alt="" />
      </div>
      <div>
        <p class="stat-value"><?= $stats['total'] ?></p>
        <p class="stat-label">Total Notes</p>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-icon pink">
        <img src="/assets/svg/stat-archive.svg" width="20" height="20" alt="" />
      </div>
      <div>
        <p class="stat-value"><?= $stats['archived'] ?></p>
        <p class="stat-label">Archived</p>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-icon violet">
        <img src="/assets/svg/stat-trash.svg" width="20" height="20" alt="" />
      </div>
      <div>
        <p class="stat-value"><?= $stats['trash'] ?></p>
        <p class="stat-label">Trash</p>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-icon lime">
        <img src="/assets/svg/stat-calendar.svg" width="20" height="20" alt="" />
      </div>
      <div>
        <p class="stat-value"><?= $stats['today'] ?></p>
        <p class="stat-label">Notes Today</p>
      </div>
    </div>
  </div>
</div>

<div class="d-flex align-items-center gap-3 mb-3 flex-wrap actions-row">
  <form method="GET" action="/" class="search-wrap">
    <img src="/assets/svg/search.svg" class="search-icon" width="16" height="16" alt="" />
    <input type="search" name="q" class="search-input" placeholder="Search notes…" autocomplete="off" value="<?= esc($search ?? '') ?>" />
    <button type="submit" class="search-submit-btn" aria-label="Search">Search</button>
  </form>
  <a href="/create" class="btn-new-note">+ New Note</a>
</div>

<div class="filter-chips">
  <a href="/" class="chip <?= $activeCategory === null ? 'active' : '' ?>">All</a>
  <?php foreach ($categories as $category): ?>
    <a href="/?category=<?= esc($category['slug']) ?>" class="chip <?= $activeCategory === $category['slug'] ? 'active' : '' ?>">
      <?= esc($category['name']) ?>
    </a>
  <?php endforeach ?>
</div>

<div class="row g-3">

  <?php if (empty($notes)): ?>
    <div class="col-12 fs-7">
      <p class="text-muted text-center py-4">No notes yet. <a href="/create">Create one</a>.</p>
    </div>
  <?php else: ?>
    <?php foreach ($notes as $note): ?>
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="note-card <?= $note['is_pinned'] ? 'note-card--pinned' : '' ?>" onclick="window.location='/<?= $note['id'] ?>'" style="cursor:pointer">
          <div class="note-card-header">
            <h3 class="note-card-title"><?= esc($note['title']) ?></h3>
            <div class="note-actions">
              <a href="/<?= $note['id'] ?>/edit" class="note-action-btn edit" title="Edit" aria-label="Edit note">
                <img src="/assets/svg/edit.svg" width="14" height="14" alt="" />
              </a>
              <form method="POST" action="/<?= $note['id'] ?>/archive" style="display:contents">
                <?= csrf_field() ?>
                <button type="submit" class="note-action-btn delete" title="Archive" aria-label="Archive note">
                  <img src="/assets/svg/archive.svg" width="14" height="14" alt="" />
                </button>
              </form>
              <form method="POST" action="/<?= $note['id'] ?>/pin" style="display:contents">
                <?= csrf_field() ?>
                <button type="submit" class="note-action-btn pin <?= $note['is_pinned'] ? 'pinned' : '' ?>" title="<?= $note['is_pinned'] ? 'Unpin' : 'Pin' ?>" aria-label="<?= $note['is_pinned'] ? 'Unpin' : 'Pin' ?> note">
                  <img src="/assets/svg/<?= $note['is_pinned'] ? 'pin-filled' : 'pin' ?>.svg" width="14" height="14" alt="" />
                </button>
              </form>
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
