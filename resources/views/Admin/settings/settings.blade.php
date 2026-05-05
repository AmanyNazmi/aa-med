<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Settings • AA-MED</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/Admin/settings.css') }}">
</head>

<body>
  <div class="layout" id="layout">

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div>
        <div class="avatar">
          <img src="{{ asset('images/admins/' . ($admin->email === 'Ahmed@gmail.com' ? 'Ahmed.jpeg' : 'Amany.jpeg')) }}?v={{ time() }}">
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

    <!-- Main -->
    <main class="main">

      <header class="page-header">
        <div class="page-left">
          <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
            <i class="fa-solid fa-bars"></i>
          </button>

          <div>
            <h1 class="title">Settings</h1>
            <p class="subtitle">Manage your account information</p>
          </div>
        </div>
      </header>

      @if (session('success'))
        <div class="flash flash-success">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="flash flash-error">Please check the form and try again.</div>
      @endif

      <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <section class="settings-layout">

          <!-- Profile -->
          <div class="settings-card">
            <div class="settings-head">
              <h3>Profile</h3>
              <i class="fa fa-user-gear"></i>
            </div>

            <div class="admin-photo">
              <img src="{{ asset('images/admins/' . $photoFile) }}?v={{ time() }}">
            </div>

            <label class="file-btn">
              Change Photo
              <input type="file" name="photo" accept="image/*">
            </label>

            <div class="field">
              <label>Full Name</label>
              <input type="text" name="name" value="{{ old('name', $admin->name) }}">
            </div>

            <div class="field">
              <label>Email</label>
              <input type="email" value="{{ $admin->email }}" readonly>
            </div>
          </div>

          <!-- Security -->
          <div class="settings-card">
            <div class="settings-head">
              <h3>Security</h3>
              <i class="fa fa-shield-halved"></i>
            </div>

            <div class="two-col">
              <div class="field">
                <label>Current Password</label>
                <input type="password" name="current_password">
              </div>

              <div class="field">
                <label>New Password</label>
                <input type="password" name="new_password">
              </div>
            </div>

            <div class="field">
              <label>Confirm New Password</label>
              <input type="password" name="new_password_confirmation">
            </div>

            <div class="actions">
              <a href="{{ route('admin.dashboard') }}" class="btnx btn-outlinex">Cancel</a>
              <button class="btnx btn-primaryx" type="submit">Save Changes</button>
            </div>
          </div>

        </section>
      </form>
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
