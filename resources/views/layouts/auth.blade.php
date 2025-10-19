<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Auth Page')</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
   .position-relative {
    position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 12px; /* distance from right */
        top: 70%;
        transform: translateY(-50%); /* vertically center */
        cursor: pointer;
        color: #6c757d;
    }
    .password-toggle:hover {
        color: #000;
    }

  </style>
</head>
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 col-lg-5 col-xl-4">
      @yield('content')
    </div>
  </div>

  @yield('scripts')
</body>
</html>
