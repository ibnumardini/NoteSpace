<nav class="app-navbar">
  <div class="navbar-inner d-flex align-items-center justify-content-between gap-3">

    <a href="<?= site_url() ?>" class="navbar-brand-app">
      <div class="logo-mark">
        <img src="/assets/svg/logo-mark.svg" width="18" height="18" alt="" />
      </div>
      <span class="brand-name">Note<span>Space</span></span>
    </a>

    <div class="d-none d-md-flex align-items-center gap-1">
      <a href="<?= site_url() ?>" class="nav-link-app <?= current_url() === site_url('/') ? 'active' : '' ?>">Notes</a>
      <a href="<?= site_url() ?>/archived" class="nav-link-app <?= str_contains(current_url(), '/archived') ? 'active' : '' ?>">Archived</a>
      <a href="<?= site_url() ?>/trash" class="nav-link-app <?= str_contains(current_url(), '/trash') ? 'active' : '' ?>">Trash</a>
    </div>

    <div class="d-flex align-items-center gap-2">
      <div class="dropdown">
        <button class="nav-user-pill" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="avatar"><?= esc(strtoupper(substr(session()->get('user_name'), 0, 2))) ?></div>
          <span class="user-name d-none d-sm-inline"><?= esc(session()->get('user_name')) ?></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end user-dropdown">
          <li><a class="dropdown-item user-dropdown-item" href="/auth/logout">Sign Out</a></li>
        </ul>
      </div>
      <button class="navbar-toggler-app d-md-none" type="button"
        data-bs-toggle="offcanvas" data-bs-target="#mobileNav"
        aria-controls="mobileNav" aria-label="Open navigation">
        <img src="/assets/svg/hamburger.svg" width="18" height="18" alt="" />
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
    <a href="<?= site_url() ?>" class="nav-link-app <?= current_url() === site_url('/') ? 'active' : '' ?>">Notes</a>
    <a href="<?= site_url() ?>/archived" class="nav-link-app <?= str_contains(current_url(), '/archived') ? 'active' : '' ?>">Archived</a>
    <a href="<?= site_url() ?>/trash" class="nav-link-app <?= str_contains(current_url(), '/trash') ? 'active' : '' ?>">Trash</a>
    <hr class="offcanvas-divider" />
    <a href="<?= site_url() ?>/auth/logout" class="nav-link-app">Sign Out</a>
  </div>
</div>
