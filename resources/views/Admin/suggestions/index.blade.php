<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Suggestions</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/Admin/suggestion.css') }}">
</head>

<body>
  <div class="layout" id="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
      <div>
        <div class="avatar">
          <img src="{{ asset('images/admins/' . ($admin->email === 'Ahmed@gmail.com' ? 'Ahmed.jpeg' : 'Amany.jpeg')) }}">
        </div>
        <div class="name">{{ $admin->name }}</div>
      </div>

      <nav class="nav">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="fa-solid fa-house"></i> <span>Home</span>
        </a>

        <a href="{{ route('admin.medicines.index') }}" class="{{ request()->routeIs('admin.medicines.*') ? 'active' : '' }}">
          <i class="fa-solid fa-capsules"></i> <span>Manage Medicines</span>
        </a>

        <a href="{{ route('admin.medicines.create') }}" class="{{ request()->routeIs('admin.medicines.create') ? 'active' : '' }}">
          <i class="fa-solid fa-square-plus"></i> <span>Add Medicine</span>
        </a>

        <a href="{{ route('admin.suggestions.index') }}" class="{{ request()->routeIs('admin.suggestions.*') ? 'active' : '' }}">
          <i class="fa-solid fa-comments"></i> <span>Suggestions</span>
        </a>

        <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
          <i class="fa-solid fa-gear"></i> <span>Settings</span>
        </a>
      </nav>

      <div class="spacer"></div>

      <div class="logout">
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button class="btn-logout" type="submit">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Log Out</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="main">
      <header class="page-header">
        <div class="page-left">
          <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
            <i class="fa-solid fa-bars"></i>
          </button>
          <div>
            <h1 class="title">Suggestions</h1>
            <p class="subtitle">Review and manage all suggestions sent to AA-MED.</p>
          </div>
        </div>
      </header>

      <form method="GET" class="filter">
        <label>Filter by</label>
        <select name="filter" onchange="this.form.submit()">
          <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All</option>
          <option value="pending" {{ $filter == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="approved" {{ $filter == 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="rejected" {{ $filter == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
      </form>

      @if (session('msg'))
        <div class="flash">{{ session('msg') }}</div>
      @endif

      <div class="list">
        @forelse($suggestions as $s)
          <div class="item">
            <div class="left">
              <div class="icon"><i class="fa-regular fa-user"></i></div>
              <div class="info">
                <h4>{{ $s->full_name }}</h4>
                <small>{{ ucfirst($s->role) }}</small>
                <p>{{ $s->sugg_text }}</p>
              </div>
            </div>

            <div class="right">
              <div class="badge {{ $s->status }}">{{ ucfirst($s->status) }}</div>
              <div class="date">{{ $s->created_at->format('M d, Y') }}</div>

              @if ($s->status === 'pending')
                <div class="actions">
                  <form method="POST" action="{{ route('admin.suggestions.approve', $s->sugg_id) }}">
                    @csrf
                    <button class="btn btn-approve" type="submit">Approve</button>
                  </form>
                  <form method="POST" action="{{ route('admin.suggestions.reject', $s->sugg_id) }}">
                    @csrf
                    <button class="btn btn-reject" type="submit">Reject</button>
                  </form>
                </div>
              @endif
            </div>
          </div>
        @empty
          <p class="empty-note">No suggestions found.</p>
        @endforelse
      </div>

      {{ $suggestions->links('pagination::bootstrap-4') }}
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
