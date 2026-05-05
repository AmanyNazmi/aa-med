<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Suggestion • AA-MED</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/p1.css') }}">
  <link rel="stylesheet" href="{{ asset('css/p4.css') }}">
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-navy shadow-sm sticky-top main-navbar">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
        <i class="bi bi-capsule me-2"></i>
        <span class="logo-text"><span class="logo-aa">AA</span>-MED</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
        aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}" href="{{ route('search') }}">Search</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('suggestion') ? 'active' : '' }}" href="{{ route('suggestion') }}">Suggestion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- MAIN -->
  <main class="suggest-main">
    <div class="container position-relative">
      @if (session('msg'))
      <div id="successCard" class="success-overlay">
        <div class="success-box text-center">
          <i class="bi bi-check-circle-fill mb-2"></i>
          <h5 class="mb-1">Suggestion sent successfully</h5>
          <p class="mb-0 small text-muted">{{ session('msg') }}</p>
        </div>
      </div>
      @endif

      @if ($errors->any())
      <div class="alert alert-danger mt-3">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <section class="hero-suggest text-center">
        <span class="hero-pill-label">HELP US IMPROVE AA-MED</span>

        <h1 class="hero-title mt-3 mb-2">
          Share a <span class="hero-highlight">suggestion</span>
        </h1>

        <p class="hero-sub">
          Spot something missing or unclear? Tell us and we’ll use your feedback<br>
          to make medicine information safer and easier to understand.
        </p>
      </section>

      <section class="suggest-card mx-auto">
        <div class="row g-4 align-items-start">
          <div class="col-lg-4">
            <div class="side-info">
              <h5 class="mb-3">
                <i class="bi bi-lightbulb me-2 text-gold"></i>
                What can I suggest?
              </h5>
              <ul class="side-list">
                <li>Missing warning or side effect.</li>
                <li>Clarifying a dose or usage note.</li>
                <li>Suggesting a new medicine to add.</li>
              </ul>
              <p class="small text-muted mt-3 mb-0">
                Suggestions are reviewed by the team. This form doesn’t replace advice from your doctor.
              </p>
            </div>
          </div>

          <div class="col-lg-8">
            <form id="sForm" action="{{ route('suggestion.store') }}" method="POST" novalidate>
              @csrf

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="name">Your full name</label>
                  <input id="name" type="text" name="full_name" class="form-control" placeholder="John Doe"
                    maxlength="100" value="{{ old('full_name') }}" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label" for="role">I'm a</label>
                  <select id="role" name="role" class="form-select" required>
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Choose...</option>
                    <option value="patient" @selected(old('role') === 'patient')>Patient</option>
                    <option value="doctor" @selected(old('role') === 'doctor')>Doctor</option>
                    <option value="pharmacist" @selected(old('role') === 'pharmacist')>Pharmacist</option>
                  </select>
                </div>
              </div>

              <div class="mt-3">
                <label class="form-label" for="email">Your email</label>
                <input id="email" type="email" name="email" class="form-control" placeholder="name@example.com"
                  maxlength="100" value="{{ old('email') }}" required>
              </div>

              <div class="mt-3">
                <label class="form-label" for="idea">Your suggestion</label>
                <textarea id="idea" name="sugg_text" class="form-control" rows="5"
                  placeholder="Write your change or suggestion here..." required>{{ old('sugg_text') }}</textarea>
              </div>

              <div class="form-check mt-3 mb-4 small">
                <input class="form-check-input" type="checkbox" value="1" id="agree" name="agree">
                <label class="form-check-label" for="agree">
                  I understand AA-MED doesn’t provide personal medical diagnosis or treatment.
                </label>
              </div>

              <div class="text-end">
                <button class="btn btn-hero" type="submit">
                  Send suggestion <i class="bi bi-arrow-right-short ms-1"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="main-footer">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
      <div class="small">© 2025 Smart Medicine Assistant. All rights reserved.</div>
      <div class="d-flex align-items-center gap-4">
        <a class="small text-decoration-none" href="#">Privacy</a>
        <a class="small text-decoration-none" href="#">Terms</a>
        <a class="small text-decoration-none" href="#">Contact</a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const successCard = document.getElementById('successCard');
    if (successCard) {
      setTimeout(() => {
        successCard.style.transition = 'opacity 0.4s ease';
        successCard.style.opacity = '0';
        setTimeout(() => successCard.remove(), 400);
      }, 2000);
    }
  </script>
</body>

</html>
