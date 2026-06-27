<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up | NoteSpace</title>
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

    <h1 class="auth-heading">Create account</h1>
    <p class="auth-subtext">Start capturing your ideas.</p>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger auth-alert" role="alert">
        <ul class="mb-0">
          <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    <?php endif ?>

    <form method="POST" action="/auth/register">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label for="regName" class="form-label">Full Name</label>
        <input type="text" id="regName" name="name" class="form-control" placeholder="Your name" required autocomplete="name" value="<?= esc($old['name'] ?? '') ?>" />
      </div>

      <div class="mb-3">
        <label for="regEmail" class="form-label">Email</label>
        <input type="email" id="regEmail" name="email" class="form-control" placeholder="you@notespace.com" required autocomplete="email" value="<?= esc($old['email'] ?? '') ?>" />
      </div>

      <div class="mb-3">
        <label for="regPassword" class="form-label">Password</label>
        <div class="input-wrap">
          <input type="password" id="regPassword" name="password" class="form-control" placeholder="Min. 8 characters" required minlength="8" autocomplete="new-password" />
          <button type="button" class="toggle-password" onclick="const i=document.getElementById('regPassword');i.type=i.type==='password'?'text':'password'" aria-label="Toggle password visibility">
            <img src="/assets/svg/eye.svg" width="18" height="18" alt="" />
          </button>
        </div>
      </div>

      <div class="mb-4">
        <label for="regConfirm" class="form-label">Confirm Password</label>
        <div class="input-wrap">
          <input type="password" id="regConfirm" name="password_confirmation" class="form-control" placeholder="Repeat your password" required autocomplete="new-password" />
          <button type="button" class="toggle-password" onclick="const i=document.getElementById('regConfirm');i.type=i.type==='password'?'text':'password'" aria-label="Toggle confirm password visibility">
            <img src="/assets/svg/eye.svg" width="18" height="18" alt="" />
          </button>
        </div>
      </div>

      <button type="submit" class="btn-primary-app">Sign Up</button>

    </form>

    <p class="auth-footer-text">
      Already have an account? <a href="/auth/login" class="auth-link">Sign In</a>
    </p>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
