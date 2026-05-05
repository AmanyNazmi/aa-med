<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Admin Login • AA-MED</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Admin/login.css') }}">
</head>
<body>

<div class="auth-shell">
  <div class="brand-side">
    <div class="brand-inner">
      <div class="brand-icon">
        <i class="bi bi-capsule"></i>
      </div>
      <div class="brand-name">AA-MED</div>
      <div class="brand-sub">Admin panel for your medical platform.</div>
    </div>
  </div>
  <div class="form-side">
    <div class="form-inner">
      <div class="mb-4 text-center text-lg-start">
        <h1 class="login-title mb-1">Welcome back</h1>
        <div class="login-sub">Sign in to continue</div>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger alert-compact d-flex align-items-center gap-2 mb-3" role="alert">
          <i class="bi bi-exclamation-triangle-fill"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.submit') }}" novalidate>
        @csrf

        <div class="mb-3 input-icon">
          <i class="bi bi-envelope"></i>
          <input type="email"
                 name="email"
                 value="{{ old('email') }}"
                 class="form-control auth @error('email') is-invalid @enderror"
                 placeholder="Email"
                 autocomplete="email"
                 required>
          @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 input-icon">
          <i class="bi bi-lock"></i>
          <input type="password"
                 name="password"
                 class="form-control auth @error('password') is-invalid @enderror"
                 placeholder="Password"
                 autocomplete="current-password"
                 required>
          @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">
              Remember me
            </label>
          </div>
        </div>

        <button class="btn btn-brand w-100 mb-2" type="submit">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Sign in</span>
        </button>

        <div class="text-center mini">
          Use your admin email &amp; password to sign in.
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
