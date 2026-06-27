<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<h1 class="auth-heading">Welcome back</h1>
<p class="auth-subtext">Sign in to your notes.</p>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success auth-alert" role="alert">
    <?= esc(session()->getFlashdata('success')) ?>
  </div>
<?php endif ?>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger auth-alert" role="alert">
    <ul class="mb-0 px-3">
      <?php foreach ($errors as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif ?>

<form method="POST" action="/auth/login">
  <?= csrf_field() ?>

  <div class="mb-3">
    <label for="loginEmail" class="form-label">Email</label>
    <input type="email" id="loginEmail" name="email" class="form-control" placeholder="you@notespace.com" required autocomplete="email" value="<?= esc($old['email'] ?? '') ?>" />
  </div>

  <div class="mb-4">
    <label for="loginPassword" class="form-label">Password</label>
    <div class="input-wrap">
      <input type="password" id="loginPassword" name="password" class="form-control" placeholder="••••••••" required autocomplete="current-password" />
      <button type="button" class="toggle-password" aria-label="Toggle password visibility">
        <img src="/assets/svg/eye.svg" width="18" height="18" alt="" />
      </button>
    </div>
  </div>

  <button type="submit" class="btn-primary-app">Sign In</button>

</form>

<p class="auth-footer-text">
  No account? <a href="/auth/register" class="auth-link">Sign Up</a>
</p>

<?= $this->endSection() ?>
