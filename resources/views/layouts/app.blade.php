<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-2 sidebar p-3 position-fixed">
        <h4 class=" text-center border-bottom pb-4">Management</h4>
        <nav>
          <ul class="nav flex-column">
            <li class="nav-item mb-2">
              <a href="{{ route('dashboard') }}" class="nav-link text-black {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door me-2"></i>Dashboard
              </a>
            </li>
            <li class="nav-item mb-2">
              <a href="{{ route('product') }}" class="nav-link text-black {{ request()->is('product') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-2"></i>Product
              </a>
            </li>
            <li class="nav-item mb-2">
              <a href="{{ route('users') }}" class="nav-link text-black {{ request()->is('users') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>Users
              </a>
            </li>
            <li class="nav-item mb-2">
              <a href="{{ route('settings') }}" class="nav-link text-black {{ request()->is('settings') ? 'active' : '' }}">
                <i class="bi bi-gear me-2"></i>Settings
              </a>
            </li>
            <li class="nav-item mb-2">
              <a href="{{ route('store') }}" class="nav-link text-black {{ request()->is('store') ? 'active' : '' }}">
                <i class="bi bi-shop me-2"></i>Store
              </a>
            </li>
          </ul>
        </nav>
        <footer>© 2025 Management System</footer>
      </div>

      <!-- Top Bar -->
      <div class="topbar d-flex align-items-center justify-content-between px-4">
          <div class="d-flex align-items-center">
              <img class="rounded-circle me-2" style="width: 45px;" src="https://thumbs.dreamstime.com/b/red-admin-sign-pc-laptop-vector-illustration-administrator-icon-screen-controller-man-system-box-88756468.jpg" alt="Admin">
              <span class="fw-semibold">Admin: Name</span>
          </div>
          <button type="button" class="btn btn-outline-danger btn-sm px-2 logout-toggle-btn rounded-4" data-bs-toggle="modal" data-bs-target="#logoutModal">
              <i class="bi bi-box-arrow-right"></i>
              <span class="logout-text">Logout</span>
          </button>
      </div>

      <!-- Logout Confirmation Modal -->  
      <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content custom-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <p>Are you sure you want to log out of your current session?</p>
                </div>
                <div class="modal-footer border-0 pt-0 d-flex justify-content-end">
                    <button type="button" class="btn btn-light custom-cancel-btn me-2" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('logout') }}" class="btn btn-danger custom-logout-btn">Logout</a>
                </div>
            </div>
        </div>
    </div>

      <!-- Main Content -->
      <div class="col-10 main-content">
        @yield('content')
      </div>
    </div>
  </div>
  @yield('scripts')

</body>
</html>
