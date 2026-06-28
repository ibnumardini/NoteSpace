<?= $this->extend('layouts/note') ?>
<?= $this->section('content') ?>

<div class="page-header">
  <h1 class="page-title">Archived</h1>
  <p class="page-subtitle">Notes you've set aside.</p>
</div>

<div class="d-flex align-items-center gap-3 mb-3 flex-wrap actions-row">
  <form method="GET" action="/archived" class="search-wrap">
    <img src="/assets/svg/search.svg" class="search-icon" width="16" height="16" alt="" />
    <input type="search" name="q" class="search-input" placeholder="Search archived…" autocomplete="off" value="<?= esc($search ?? '') ?>" />
    <button type="submit" class="search-submit-btn" aria-label="Search">Search</button>
  </form>
</div>

<div class="filter-chips">
  <a href="/archived" class="chip <?= $activeCategory === null ? 'active' : '' ?>">All</a>
  <?php foreach ($categories as $category): ?>
    <a href="/archived?category=<?= esc($category['slug']) ?>" class="chip <?= $activeCategory === $category['slug'] ? 'active' : '' ?>">
      <?= esc($category['name']) ?>
    </a>
  <?php endforeach ?>
</div>

<div class="row g-3">

  <?php if (empty($notes)): ?>
    <div class="col-12 fs-7">
      <p class="text-muted text-center py-4">No archived notes.</p>
    </div>
  <?php else: ?>
    <?php foreach ($notes as $note): ?>
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="note-card" onclick="window.location='/<?= $note['id'] ?>'" style="cursor:pointer">
          <div class="note-card-header">
            <h3 class="note-card-title"><?= esc($note['title']) ?></h3>
            <div class="note-actions">
              <button class="note-action-btn edit" title="Restore" aria-label="Restore note">
                <img src="/assets/svg/unarchive.svg" width="14" height="14" alt="" />
              </button>
              <button class="note-action-btn delete" title="Delete" aria-label="Delete note">
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