<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?> | NoteSpace</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/assets/css/app.css" />
</head>
<body class="auth-page">

  <div class="auth-card">

    <div class="auth-logo">
      <div class="logo-mark">
        <img src="/assets/svg/logo-mark.svg" width="20" height="20" alt="" />
      </div>
      <span class="logo-text">Note<span>Space</span></span>
    </div>

    <?= $this->renderSection('content') ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/app.js"></script>
</body>
</html>
