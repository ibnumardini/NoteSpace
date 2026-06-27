<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<h1 class="auth-heading">Create account</h1>
<p class="auth-subtext">Start capturing your ideas.</p>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger auth-alert" role="alert">
    <ul class="mb-0 px-3">
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
      <button type="button" class="toggle-password" aria-label="Toggle password visibility">
        <img src="/assets/svg/eye.svg" width="18" height="18" alt="" />
      </button>
    </div>
  </div>

  <div class="mb-4">
    <label for="regConfirm" class="form-label">Confirm Password</label>
    <div class="input-wrap">
      <input type="password" id="regConfirm" name="password_confirmation" class="form-control" placeholder="Repeat your password" required autocomplete="new-password" />
      <button type="button" class="toggle-password" aria-label="Toggle confirm password visibility">
        <img src="/assets/svg/eye.svg" width="18" height="18" alt="" />
      </button>
    </div>
  </div>

  <button type="submit" class="btn-primary-app">Sign Up</button>

</form>

<p class="auth-footer-text">
  Already have an account? <a href="/auth/login" class="auth-link">Sign In</a>
</p>

<?= $this->endSection() ?>
