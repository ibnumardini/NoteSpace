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
        <img src="/assets/svg/stat-tag.svg" width="20" height="20" alt="" />
      </div>
      <div>
        <p class="stat-value"><?= $stats['categories'] ?></p>
        <p class="stat-label">Categories</p>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-icon violet">
        <img src="/assets/svg/stat-pin.svg" width="20" height="20" alt="" />
      </div>
      <div>
        <p class="stat-value"><?= $stats['pinned'] ?></p>
        <p class="stat-label">Pinned</p>
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
        <p class="stat-label">Today</p>
      </div>
    </div>
  </div>
</div>

<div class="d-flex align-items-center gap-3 mb-3 flex-wrap actions-row">
  <form method="GET" action="/notes" class="search-wrap">
    <img src="/assets/svg/search.svg" class="search-icon" width="16" height="16" alt="" />
    <input type="search" name="q" class="search-input" placeholder="Search notes…" autocomplete="off" />
    <button type="submit" class="search-submit-btn" aria-label="Search">Search</button>
  </form>
  <a href="/notes/create" class="btn-new-note">+ New Note</a>
</div>

<div class="filter-chips">
  <button type="button" class="chip active">All</button>
  <button type="button" class="chip">Work</button>
  <button type="button" class="chip">Personal</button>
  <button type="button" class="chip">Ideas</button>
  <button type="button" class="chip">To-Do</button>
</div>

<div class="row g-3">

  <div class="col-12 col-sm-6 col-lg-4">
    <div class="note-card note-card--pinned" onclick="window.location='/notes/1'" style="cursor:pointer">
      <div class="note-card-header">
        <h3 class="note-card-title">Rencana Sprint</h3>
        <div class="note-actions">
          <a href="/notes/1/edit" class="note-action-btn edit" title="Edit" aria-label="Edit note">
            <img src="/assets/svg/edit.svg" width="14" height="14" alt="" />
          </a>
          <button class="note-action-btn delete" title="Archive" aria-label="Archive note">
            <img src="/assets/svg/archive.svg" width="14" height="14" alt="" />
          </button>
          <button class="note-action-btn pin pinned" title="Unpin" aria-label="Unpin note">
            <img src="/assets/svg/pin-filled.svg" width="14" height="14" alt="" />
          </button>
        </div>
      </div>
      <p class="note-card-snippet">Review backlog, tentukan story points, dan finalisasi scope bersama tim.</p>
      <div class="note-card-footer">
        <span class="note-date">Jun 19, 2026</span>
        <span class="badge-category badge-work">Work</span>
      </div>
    </div>
  </div>

</div>

<script>
  document.querySelectorAll('.note-actions').forEach(el => {
    el.addEventListener('click', e => e.stopPropagation());
  });
</script>

<?= $this->endSection() ?>
