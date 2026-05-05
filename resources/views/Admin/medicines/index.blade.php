<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Medicines</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Admin/main.css') }}">



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
            <i class="fa-solid fa-xmark"></i>
          </button>
          <div>
            <h1 class="title">Manage Medicines</h1>
            <p class="subtitle">Search, edit, or delete medicines in the AA-MED database.</p>
          </div>
        </div>

        <a href="{{ route('admin.medicines.create') }}" class="btn-add">
          <i class="fa-solid fa-plus"></i> Add New Medicine
        </a>
      </header>

      @if (session('msg'))
        <div class="flash">{{ session('msg') }}</div>
      @endif

      <div class="toolbar">
        <form class="search" method="GET" action="{{ route('admin.medicines.index') }}">
          <i class="fa-solid fa-magnifying-glass icon"></i>
          <input type="text" name="q" value="{{ $q }}" placeholder="Search medicine by name ...">
        </form>
      </div>

      <div class="card">
        <table>
          <thead>
            <tr>
              <th style="width:110px;">ID</th>
              <th>Name</th>
              <th style="width:28%;">Alternative</th>
              <th style="width:160px;">Prescription?</th>
              <th style="width:160px;">Action</th>
            </tr>
          </thead>

          <tbody>
            @forelse($medicines as $m)
              <tr class="m-row">
                <td data-label="ID">{{ $m->med_id }}</td>
                <td data-label="Name">{{ $m->med_name }}</td>
                <td data-label="Alternative">{{ $m->alter_med ?: '—' }}</td>
                <td data-label="Prescription?">
                  @if ($m->pres_required)
                    <span class="tag red">Yes</span>
                  @else
                    <span class="tag green">No</span>
                  @endif
                </td>
                <td data-label="Action">
                  <div class="actions">
                    <a class="icon-btn" title="Edit" href="{{ route('admin.medicines.edit', $m->med_id) }}">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.medicines.destroy', $m->med_id) }}" onsubmit="return confirm('Delete this medicine?')">
                      @csrf @method('DELETE')
                      <button class="icon-btn" title="Delete" type="submit">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="empty">No medicines found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        @if ($medicines->hasPages())
          @php
            $current = $medicines->currentPage();
            $last = $medicines->lastPage();
          @endphp

          <div class="pagination">
            <a class="page-btn" href="{{ $medicines->previousPageUrl() ?? '#' }}" {{ $medicines->onFirstPage() ? 'disabled' : '' }}>
              <i class="fa-solid fa-chevron-left"></i> Prev
            </a>

            @for ($i = 1; $i <= $last; $i++)
              @if ($i == $current)
                <span class="page-num active">{{ $i }}</span>
              @elseif ($i == 1 || $i == $last || abs($i - $current) <= 2)
                <a class="page-num" href="{{ $medicines->url($i) }}">{{ $i }}</a>
              @elseif ($i == 2 && $current > 4)
                <span class="page-num">…</span>
              @elseif ($i == $last - 1 && $current < $last - 3)
                <span class="page-num">…</span>
              @endif
            @endfor

            <a class="page-btn" href="{{ $medicines->nextPageUrl() ?? '#' }}" {{ $current == $last ? 'disabled' : '' }}>
              Next <i class="fa-solid fa-chevron-right"></i>
            </a>
          </div>
        @endif
      </div>
    </main>
  </div>

  <script>
    const layout = document.getElementById('layout');
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarToggleIcon = sidebarToggle.querySelector('i');

    const isMobile = () => window.matchMedia('(max-width: 768px)').matches;

    function setIcon() {
      const open = layout.classList.contains('sidebar-open');
      const collapsed = layout.classList.contains('sidebar-collapsed');

      if (isMobile()) {
        sidebarToggleIcon.className = open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
      } else {
        sidebarToggleIcon.className = collapsed ? 'fa-solid fa-bars' : 'fa-solid fa-xmark';
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
