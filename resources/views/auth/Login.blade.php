@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card shadow-lg p-4 custom-card border-0">
  <div class="card-body">
    <h3 class="fw-bold text-center mb-3">Welcome Back!</h3>
    <p class="text-muted text-center mb-4">Sign in to continue to the Dashboard.</p>

    {{-- ✅ Show error messages --}}
    @if (session('error'))
      <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- ✅ Validation errors --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label fw-bold">Email Address</label>
        <input 
          type="email" 
          class="form-control input-clean @error('email') is-invalid @enderror" 
          id="email" 
          name="email" 
          value="{{ old('email') }}"
          required 
          autofocus
        >
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3 position-relative">
        <label for="password" class="form-label fw-bold">Password</label>
        <input 
          type="password" 
          class="form-control input-clean @error('password') is-invalid @enderror" 
          id="password" 
          name="password" 
          required
        >
        <span class="password-toggle" onclick="togglePassword('password')">
          <i class="bi bi-eye-fill"></i>
        </span>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-dark btn-lg custom-btn">Log In</button>
      </div>
    </form>

    <p class="text-center mt-4 mb-0">
      Don't have an account?
      <a href="{{ route('register.form') }}" class="text-dark fw-bold text-decoration-none">Register</a>
    </p>
  </div>
</div>
@endsection

@section('scripts')
<script>
function togglePassword(id) {
  const input = document.getElementById(id);
  const icon = input.nextElementSibling.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
  } else {
    input.type = 'password';
    icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
  }
}
</script>

<style>
.input-clean {
  border: none !important;
  border-bottom: 2px solid #ddd !important;
  border-radius: 0 !important;
  box-shadow: none !important;
  transition: border-color 0.3s ease;
}
.input-clean:focus {
  border-color: #000 !important;
  outline: none !important;
  box-shadow: none !important;
}
.password-toggle {
  position: absolute;
  right: 10px;
  top: 65%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #888;
}
.password-toggle:hover {
  color: #000;
}
</style>
@endsection
