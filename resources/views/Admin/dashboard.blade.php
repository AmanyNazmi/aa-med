<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard • AA-MED</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/Admin/dashboard.css') }}">
</head>

<body>
  <div class="layout" id="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
      <div>
        <div class="avatar">
          <img src="{{ asset('images/admins/' . ($admin->email === 'Ahmed@gmail.com' ? 'Ahmed.jpeg' : 'Amany.jpeg')) }}?v={{ time() }}" alt="Admin">
        </div>
        <div class="name">{{ $admin->name }}</div>
      </div>

      <nav class="nav">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> <span>Home</span></a>
        <a href="{{ route('admin.medicines.index') }}" class="{{ request()->routeIs('admin.medicines.*') ? 'active' : '' }}"><i class="fa-solid fa-capsules"></i> <span>Manage Medicines</span></a>
        <a href="{{ route('admin.medicines.create') }}" class="{{ request()->routeIs('admin.medicines.create') ? 'active' : '' }}"><i class="fa-solid fa-square-plus"></i> <span>Add Medicine</span></a>
        <a href="{{ route('admin.suggestions.index') }}" class="{{ request()->routeIs('admin.suggestions.*') ? 'active' : '' }}"><i class="fa-solid fa-comments"></i> <span>Suggestions</span></a>
        <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="fa-solid fa-gear"></i> <span>Settings</span></a>
      </nav>

      <div class="spacer"></div>

      <div class="logout">
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button class="btn-logout" type="submit"><i class="fa-solid fa-right-from-bracket"></i> <span>Log Out</span></button>
        </form>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="main">
      <header class="page-header">
        <div class="page-left">
          <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle sidebar"><i class="fa-solid fa-bars"></i></button>
          <div>
            <h1 class="title">Welcome {{ $admin->name }}</h1>
            <p class="subtitle">Here is an overview of your AA-MED admin panel.</p>
          </div>
        </div>

        <div class="header-meta">
          <i class="fa-regular fa-calendar"></i>
          <span>{{ now()->format('d M Y') }}</span>
        </div>
      </header>

      <section class="stats">
        <div class="card">
          <div>
            <i class="fa-solid fa-pills"></i>
            <h3>Total Medicines</h3>
          </div>
          <span>{{ $totalMedicines }}</span>
        </div>

        <div class="card">
          <div>
            <i class="fa-solid fa-hourglass-half"></i>
            <h3>Pending Suggestions</h3>
          </div>
          <span>{{ $pendingSuggestions }}</span>
        </div>

        <div class="card">
          <div>
            <i class="fa-solid fa-plus-circle"></i>
            <h3>New Additions This Week</h3>
          </div>
          <span>{{ $newAdditions }}</span>
        </div>

        <div class="card">
          <div>
            <i class="fa-solid fa-chart-line"></i>
            <h3>Visitors</h3>
          </div>
          <span>{{ $visitorCount }}</span>
        </div>
      </section>
    </main>

  </div>

  <script>
    const layout = document.getElementById('layout');
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const icon = sidebarToggle.querySelector('i');

    const isMobile = () => window.matchMedia('(max-width: 768px)').matches;

    function setIcon() {
      const open = layout.classList.contains('sidebar-open');
      const collapsed = layout.classList.contains('sidebar-collapsed');

      if (isMobile()) {
        icon.className = open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
      } else {
        icon.className = collapsed ? 'fa-solid fa-bars' : 'fa-solid fa-xmark';
      }
    }

    sidebarToggle.addEventListener('click', () => {
      if (isMobile()) {
        layout.classList.toggle('sidebar-open');
      } else {
        layout.classList.toggle('sidebar-collapsed');
      }
      setIcon();
    });

    document.addEventListener('click', (e) => {
      if (!isMobile()) return;
      if (!layout.classList.contains('sidebar-open')) return;

      const clickedInsideSidebar = sidebar.contains(e.target);
      const clickedToggle = sidebarToggle.contains(e.target);

      if (!clickedInsideSidebar && !clickedToggle) {
        layout.classList.remove('sidebar-open');
        setIcon();
      }
    });

    window.addEventListener('resize', () => {
      if (!isMobile()) layout.classList.remove('sidebar-open');
      setIcon();
    });

    setIcon();
  </script>
</body>
</html>
