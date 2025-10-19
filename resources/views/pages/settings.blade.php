@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<!-- <div class="container"> -->
    <header class="mb-4">
        <h1 class="fw-bold settings-header-text">Settings</h1>
        <p class="text-muted settings-subheader-text">Manage your account and application preferences.</p>
    </header>

    <!-- <div class="card settings-card mb-5 border-0">
        <div class="card-body p-4 p-md-5">
            <h5 class="fw-bold card-title-dark">Profile Information</h5>
            <p class="text-muted mb-4 card-subtitle-small">Update your account profile information and email address.</p>

            <form>
                <div class="mb-3">
                    <label for="fullName" class="form-label form-label-custom">Full Name</label>
                    <input type="text" class="form-control form-control-custom" id="fullName" value="Admin User" required>
                </div>

                <div class="mb-3">
                    <label for="emailAddress" class="form-label form-label-custom">Email Address</label>
                    <input type="email" class="form-control form-control-custom" id="emailAddress" value="admin@example.com" required>
                </div>

                <div class="mb-4">
                    <label for="phoneNumber" class="form-label form-label-custom">Phone Number</label>
                    <input type="tel" class="form-control form-control-custom" id="phoneNumber" value="+1 234 567 8900">
                </div>
                
                <button type="submit" class="btn btn-dark btn-custom-dark">Save Changes</button>
            </form>
        </div>
    </div> -->
    
    <div class="card settings-card border-0">
        <div class="card-body p-4 p-md-5">
            <h5 class="fw-bold card-title-dark">Security</h5>
            <p class="text-muted mb-4 card-subtitle-small">Manage your password and security settings.</p>

            <form action="{{ route('settings.updatePassword') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="currentPassword" class="form-label form-label-custom">Current Password</label>
                    <input type="password" name="currentPassword" class="form-control form-control-custom" id="currentPassword" required>
                    @error('currentPassword')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="newPassword" class="form-label form-label-custom">New Password</label>
                    <input type="password" name="newPassword" class="form-control form-control-custom" id="newPassword" required>
                    @error('newPassword')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-4">
                    <label for="confirmNewPassword" class="form-label form-label-custom">Confirm New Password</label>
                    <input type="password" name="newPassword_confirmation" class="form-control form-control-custom" id="confirmNewPassword" required>
                </div>

                <button type="submit" class="btn btn-dark btn-custom-dark">Update Password</button>
            </form>

            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

        </div>
    </div>
<!-- </div> -->

<style>
    /* General input and select style */
.form-control,
.form-select {
  box-shadow: none !important;
  border: 1px solid #ddd !important;
  border-radius: 8px !important;
  background-color: #fafafa !important;
  transition: all 0.3s ease;
}

/* On focus — slightly darker border and white background */
.form-control:focus,
.form-select:focus {
  border-color: #333 !important;
  background-color: #fff !important;
  box-shadow: none !important;
  outline: none !important;
}

/* Label */
.form-label {
  font-weight: 600;
  color: #333;
  margin-bottom: 4px;
}

/* Modal content — no shadow */
.modal-content {
  border: none !important;
  box-shadow: none !important;
  border-radius: 12px !important;
  background-color: #fff !important;
}

/* Buttons — flat, clean */
.btn {
  box-shadow: none !important;
  border-radius: 6px !important;
}

/* Optional subtle hover for input fields */
.form-control:hover,
.form-select:hover {
  border-color: #999 !important;
}

/* Placeholder color */
::placeholder {
  color: #aaa !important;
  opacity: 0.9;
}
</style>
@endsection