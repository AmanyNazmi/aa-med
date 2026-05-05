<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Medicine</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/Admin/edit.css') }}">


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
            <h1 class="title">Edit Medicine</h1>
            <p class="subtitle">Update the information of an existing medicine.</p>
          </div>
        </div>
      </header>

      <div class="form-card">
        <form method="POST" action="{{ route('admin.medicines.update', $medicine->med_id) }}">
          @csrf @method('PUT')

          <div class="grid">
            <div class="full">
              <label>Medicine Name</label>
              <input type="text" name="med_name" value="{{ old('med_name', $medicine->med_name) }}" required>
              @error('med_name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
              <label>Uses</label>
              <input type="text" name="med_use" value="{{ old('med_use', $medicine->med_use) }}">
              @error('med_use') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
              <label>Warning</label>
              <input type="text" name="med_warning" value="{{ old('med_warning', $medicine->med_warning) }}">
              @error('med_warning') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="full">
              <label>Side Effect</label>
              <textarea name="side_eff">{{ old('side_eff', $medicine->side_eff) }}</textarea>
              @error('side_eff') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
              <label>Pregnancy</label>
              <input type="text" name="preg_warning" value="{{ old('preg_warning', $medicine->preg_warning) }}">
              @error('preg_warning') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
              <label>Alternative</label>
              <input type="text" name="alter_med" value="{{ old('alter_med', $medicine->alter_med) }}">
              @error('alter_med') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="check">
              <input type="checkbox" id="prx" name="pres_required" value="1" {{ old('pres_required', $medicine->pres_required) ? 'checked' : '' }}>
              <label for="prx">Prescription required</label>
            </div>
          </div>

          <div class="actions">
            <button class="btn-primary" type="submit">Update</button>
            <a class="btn-secondary" href="{{ route('admin.medicines.index') }}">Cancel</a>
          </div>
        </form>
      </div>
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

    // Close sidebar on mobile when clicking outside
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
