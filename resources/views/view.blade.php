<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $medicine->med_name }} • Smart Medicine Assistant</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/p1.css') }}">
  <link rel="stylesheet" href="{{ asset('css/p3.css') }}">
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-navy shadow-sm sticky-top main-navbar">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
        <i class="bi bi-capsule me-2"></i>
        <span class="logo-text">
          <span class="logo-aa">AA</span>-MED
        </span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
              aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('search') }}">Search</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('suggestion') }}">Suggestion</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="result-page">
    <div class="result-search">
      <form action="{{ route('view') }}" method="GET" class="position-relative">
        <input type="text"
               class="form-control result-search-input"
               name="q"
               value="{{ old('q', $medicine->med_name ?? $q ?? '') }}"
               placeholder="Search another medicine...">
        <button class="result-search-btn" type="submit" aria-label="Search">
          <i class="bi bi-search"></i>
        </button>
      </form>
    </div>

    <div class="container">


      <div class="med-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <div>
          <div class="med-label">Medicine</div>
          <h1 class="med-name">{{ $medicine->med_name }}</h1>
          <p class="med-subtitle">Key details, guidance and safe-use tips in one place.</p>
        </div>

        <div class="mt-3 mt-md-0">
          <span class="badge pres-badge {{ $medicine->pres_required ? 'pres-yes' : 'pres-no' }}">
            <i class="bi {{ $medicine->pres_required ? 'bi-file-earmark-lock' : 'bi-check-circle' }} me-1"></i>
            Prescription Required: {{ $medicine->pres_required ? 'Yes' : 'No' }}
          </span>
        </div>
      </div>

      <!-- Tabs -->
      <ul class="nav nav-tabs result-tabs mb-4">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#uses">Uses</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#effects">Side Effects</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#warning">Warnings</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#pregnancy">Pregnancy</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#alt">Alternatives</a></li>
      </ul>

      <!-- محتوى التابات -->
      <div class="tab-content mb-4">

        <div class="tab-pane fade show active" id="uses">
          <div class="info-card">
            <h5><i class="bi bi-hospital"></i> Uses</h5>
            <p style="white-space:pre-wrap">{{ $medicine->med_use ?: '—' }}</p>
          </div>
        </div>

        <div class="tab-pane fade" id="effects">
          <div class="info-card">
            <h5><i class="bi bi-heart-pulse"></i> Side Effects</h5>
            <p style="white-space:pre-wrap">{{ $medicine->side_eff ?: '—' }}</p>
          </div>
        </div>

        <div class="tab-pane fade" id="warning">
          <div class="info-card">
            <h5 class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Warnings</h5>
            <p style="white-space:pre-wrap">{{ $medicine->med_warning ?: '—' }}</p>
          </div>
        </div>

        <div class="tab-pane fade" id="pregnancy">
          <div class="info-card">
            <h5><i class="bi bi-gender-female"></i> Pregnancy</h5>
            <p style="white-space:pre-wrap">{{ $medicine->preg_warning ?: '—' }}</p>
          </div>
        </div>

        <div class="tab-pane fade" id="alt">
          <div class="info-card">
            <h5><i class="bi bi-list-ul"></i> Alternatives</h5>
            <p style="white-space:pre-wrap">{{ $medicine->alter_med ?: '—' }}</p>
          </div>
        </div>

      </div>

    </div>
  </main>

  <!-- FOOTER -->
  <footer class="main-footer">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
      <div class="small">© 2025 Smart Medicine Assistant. All rights reserved.</div>
      <div class="d-flex align-items-center gap-4 footer-links">
        <a class="small text-decoration-none" href="#">Privacy</a>
        <a class="small text-decoration-none" href="#">Terms</a>
        <a class="small text-decoration-none" href="#">Contact</a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
