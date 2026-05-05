<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Search • Smart Medicine Assistant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/p1.css') }}">
  <link rel="stylesheet" href="{{ asset('css/p2.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-navy shadow-sm sticky-top main-navbar">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
        <i class="bi bi-capsule me-2"></i>
        <span class="logo-text"><span class="logo-aa">AA</span>-MED</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('search') }}">Search</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('suggestion') }}">Suggestion</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- MAIN SEARCH SECTION -->
  <main class="search-page flex-grow-1">
    <div class="container text-center" style="max-width:680px">
      @if(session('msg'))
        <div class="alert alert-warning mb-4 mt-2">{{ session('msg') }}</div>
      @endif

      <div class="search-title">
        <span class="search-word">Search</span>
        <span class="search-sub">for a medicine</span>
      </div>

      <p class="search-caption">
        Type a medicine name to view uses, precautions and side effects in simple, clear language.
      </p>

      <form id="searchForm" class="search-wrap" role="search" action="{{ route('view') }}" method="GET">
        <i class="bi bi-search search-icon" aria-hidden="true"></i>

        <input id="q" name="q" type="text" class="form-control search-input" placeholder="Search for medicine name..." autocomplete="off" required>

        <button class="search-btn" type="submit" aria-label="Search">
          <i class="bi bi-arrow-right-short"></i>
        </button>
      </form>

      <div class="search-chips mt-4">
        <button type="button" class="chip-btn">Pain relief</button>
        <button type="button" class="chip-btn">Allergy</button>
        <button type="button" class="chip-btn">Antibiotic</button>
        <button type="button" class="chip-btn">Cold &amp; Flu</button>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="main-footer mt-auto">
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

  <script>
    const form = document.getElementById('searchForm');
    const input = document.getElementById('q');

    if (input && form) {
      input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') form.submit();
      });
    }
  </script>
</body>
</html>
