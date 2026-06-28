<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?> | NoteSpace</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/app.css" />
</head>
<body class="dashboard-page">

  <nav class="app-navbar">
    <div class="navbar-inner d-flex align-items-center justify-content-between gap-3">

      <a href="dashboard.html" class="navbar-brand-app">
        <div class="logo-mark">
          <img src="assets/svg/logo-mark.svg" width="18" height="18" alt="" />
        </div>
        <span class="brand-name">Note<span>Space</span></span>
      </a>

      <div class="d-none d-md-flex align-items-center gap-1">
        <a href="dashboard.html" class="nav-link-app active">Notes</a>
        <a href="archive.html" class="nav-link-app">Archived</a>
        <a href="trash.html" class="nav-link-app">Trash</a>
      </div>

      <div class="d-flex align-items-center gap-2">
        <div class="dropdown">
          <button class="nav-user-pill" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="avatar">FK</div>
            <span class="user-name d-none d-sm-inline">Fatkurosky K.</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end user-dropdown">
            <li><a class="dropdown-item user-dropdown-item" href="login.html">Sign Out</a></li>
          </ul>
        </div>
        <button class="navbar-toggler-app d-md-none" type="button"
          data-bs-toggle="offcanvas" data-bs-target="#mobileNav"
          aria-controls="mobileNav" aria-label="Open navigation">
          <img src="assets/svg/hamburger.svg" width="18" height="18" alt="" />
        </button>
      </div>

    </div>
  </nav>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
    <div class="offcanvas-header offcanvas-header-app">
      <span class="offcanvas-title-app" id="mobileNavLabel">Menu</span>
      <button type="button" class="btn-close-app" data-bs-dismiss="offcanvas" aria-label="Close">✕</button>
    </div>
    <div class="offcanvas-body d-flex flex-column gap-1 pt-3">
      <a href="dashboard.html" class="nav-link-app active">Notes</a>
      <a href="archive.html" class="nav-link-app">Archived</a>
      <a href="trash.html" class="nav-link-app">Trash</a>
      <hr class="offcanvas-divider" />
      <a href="login.html" class="nav-link-app">Sign Out</a>
    </div>
  </div>

  <main class="dashboard-main">

    <div class="page-header">
      <h1 class="page-title">My Notes</h1>
      <p class="page-subtitle">All your thoughts, captured.</p>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon lime">
            <img src="assets/svg/stat-notes.svg" width="20" height="20" alt="" />
          </div>
          <div>
            <p class="stat-value">4</p>
            <p class="stat-label">Total Notes</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon pink">
            <img src="assets/svg/stat-tag.svg" width="20" height="20" alt="" />
          </div>
          <div>
            <p class="stat-value">3</p>
            <p class="stat-label">Categories</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon violet">
            <img src="assets/svg/stat-pin.svg" width="20" height="20" alt="" />
          </div>
          <div>
            <p class="stat-value">1</p>
            <p class="stat-label">Pinned</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon lime">
            <img src="assets/svg/stat-calendar.svg" width="20" height="20" alt="" />
          </div>
          <div>
            <p class="stat-value">1</p>
            <p class="stat-label">Today</p>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex align-items-center gap-3 mb-3 flex-wrap actions-row">
      <form method="GET" action="/notes" class="search-wrap">
        <img src="assets/svg/search.svg" class="search-icon" width="16" height="16" alt="" />
        <input type="search" name="q" class="search-input" placeholder="Search notes…" autocomplete="off" />
        <button type="submit" class="search-submit-btn" aria-label="Search">Search</button>
      </form>
      <a href="note-create.html" class="btn-new-note">+ New Note</a>
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
        <div class="note-card note-card--pinned" onclick="window.location='note-detail.html'" style="cursor:pointer">
          <div class="note-card-header">
            <h3 class="note-card-title">Rencana Sprint</h3>
            <div class="note-actions">
              <a href="note-edit.html" class="note-action-btn edit" title="Edit" aria-label="Edit note">
                <img src="assets/svg/edit.svg" width="14" height="14" alt="" />
              </a>
              <button class="note-action-btn delete" title="Archive" aria-label="Archive note">
                <img src="assets/svg/archive.svg" width="14" height="14" alt="" />
              </button>
              <button class="note-action-btn pin pinned" title="Unpin" aria-label="Unpin note">
                <img src="assets/svg/pin-filled.svg" width="14" height="14" alt="" />
              </button>
            </div>
          </div>
          <p class="note-card-snippet">Review backlog, tentukan story points, dan finalisasi scope bersama tim. Pastikan refactor modul autentikasi masuk sprint ini kalau kapasitas memungkinkan.</p>
          <div class="note-card-footer">
            <span class="note-date">Jun 19, 2026</span>
            <span class="badge-category badge-work">Work</span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4">
        <div class="note-card" onclick="window.location='note-detail.html'" style="cursor:pointer">
          <div class="note-card-header">
            <h3 class="note-card-title">Daftar Buku Musim Panas</h3>
            <div class="note-actions">
              <a href="note-edit.html" class="note-action-btn edit" title="Edit" aria-label="Edit note">
                <img src="assets/svg/edit.svg" width="14" height="14" alt="" />
              </a>
              <button class="note-action-btn delete" title="Archive" aria-label="Archive note">
                <img src="assets/svg/archive.svg" width="14" height="14" alt="" />
              </button>
              <button class="note-action-btn pin" title="Pin" aria-label="Pin note">
                <img src="assets/svg/pin.svg" width="14" height="14" alt="" />
              </button>
            </div>
          </div>
          <p class="note-card-snippet">The Pragmatic Programmer, Clean Code, Designing Data-Intensive Applications, dan mungkin Atomic Habits sebagai selingan.</p>
          <div class="note-card-footer">
            <span class="note-date">Jun 18, 2026</span>
            <span class="badge-category badge-personal">Personal</span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4">
        <div class="note-card" onclick="window.location='note-detail.html'" style="cursor:pointer">
          <div class="note-card-header">
            <h3 class="note-card-title">Setup Dev Environment</h3>
            <div class="note-actions">
              <a href="note-edit.html" class="note-action-btn edit" title="Edit" aria-label="Edit note">
                <img src="assets/svg/edit.svg" width="14" height="14" alt="" />
              </a>
              <button class="note-action-btn delete" title="Archive" aria-label="Archive note">
                <img src="assets/svg/archive.svg" width="14" height="14" alt="" />
              </button>
              <button class="note-action-btn pin" title="Pin" aria-label="Pin note">
                <img src="assets/svg/pin.svg" width="14" height="14" alt="" />
              </button>
            </div>
          </div>
          <p class="note-card-snippet">Install Herd, config Valet, setup MySQL & Redis. Pastikan PHP 8.3 aktif dan extension yang dibutuhkan sudah terpasang.</p>
          <div class="note-card-footer">
            <span class="note-date">Jun 17, 2026</span>
            <span class="badge-category badge-work">Work</span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4">
        <div class="note-card" onclick="window.location='note-detail.html'" style="cursor:pointer">
          <div class="note-card-header">
            <h3 class="note-card-title">Ide Fitur Notifikasi</h3>
            <div class="note-actions">
              <a href="note-edit.html" class="note-action-btn edit" title="Edit" aria-label="Edit note">
                <img src="assets/svg/edit.svg" width="14" height="14" alt="" />
              </a>
              <button class="note-action-btn delete" title="Archive" aria-label="Archive note">
                <img src="assets/svg/archive.svg" width="14" height="14" alt="" />
              </button>
              <button class="note-action-btn pin" title="Pin" aria-label="Pin note">
                <img src="assets/svg/pin.svg" width="14" height="14" alt="" />
              </button>
            </div>
          </div>
          <p class="note-card-snippet">Push notif via Laravel Notification + Firebase. Bisa digest harian atau real-time tergantung kebutuhan user.</p>
          <div class="note-card-footer">
            <span class="note-date">Jun 15, 2026</span>
            <span class="badge-category badge-ideas">Ideas</span>
          </div>
        </div>
      </div>

    </div>

  </main>

  <footer class="app-footer">
    <div class="app-footer-inner">
      <span>&copy; 2026 NoteSpace. All rights reserved.</span>
      <div class="app-footer-links">
        Built by <a href="https://ibnu.mardini.dev" target="_blank" rel="noopener noreferrer">Muhammad Fatkurozi</a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.note-actions').forEach(el => {
      el.addEventListener('click', e => e.stopPropagation());
    });
  </script>
</body>
</html>
