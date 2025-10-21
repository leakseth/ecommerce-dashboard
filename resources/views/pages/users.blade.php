@extends('layouts.app')

@section('title', 'users')

@section('content')
        <header class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold header-text">Users</h1>
                <p class="text-muted subheader-text">Manage user accounts and permissions.</p>
            </div>
            <button class="btn btn-dark add-user-btn" data-bs-target="#addUserModal" data-bs-toggle="modal">
               <i class="bi bi-plus-circle-dotted"></i> Add User
            </button>
        </header>

        <div class="row g-4">
            @foreach ($users as $user)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card user-card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="initials-circle bg-light text-dark fw-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <!-- Edit Button -->
                                            <button 
                                                type="button" 
                                                class="dropdown-item custom-dropdown-item text-primary edit-user-btn"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editUserModal"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-phone="{{ $user->phone }}"
                                                data-role="{{ $user->role }}"
                                            >
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <!-- Delete Button triggers modal -->
                                            <button 
                                                type="button" 
                                                class="dropdown-item custom-dropdown-item text-danger"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteUserModal"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                            >
                                                Delete
                                            </button>
                                        </li>
                                    </ul>


                                </div>
                            </div>

                            <h5 class="card-title fw-bold">{{ $user->name }}</h5>
                            <span class="badge role-badge role-{{ $user->role == 1 ? 'manager' : 'user' }}">
                                {{ $user->role == 1 ? 'Admin' : 'User' }}
                            </span>
                            <div class="contact-info mb-2">
                                <i class="fas fa-envelope me-2 text-muted icon-size"></i>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none contact-text">{{ $user->email }}</a>
                            </div>
                            <div class="contact-info mb-3">
                                <i class="fas fa-phone me-2 text-muted icon-size"></i>
                                <span class="contact-text">{{ $user->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            <!-- Add User Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-modal-content p-3">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold" id="addUserModalLabel">Add New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form id="addUserForm" action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="modal-body pt-2">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Full Name</label>
                                    <input type="text" name="name" class="form-control custom-form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control custom-form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Phone</label>
                                    <input type="text" name="phone" class="form-control custom-form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Password</label>
                                    <input type="password" name="password" class="form-control custom-form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Role</label>
                                    <select name="role" class="form-select custom-form-control" required>
                                        <option value="1">Admin</option>
                                        <option value="0">User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer border-0 pt-3">
                                <button type="button" class="btn btn-light custom-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-dark custom-save-btn">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit User Modal -->
            <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-modal-content p-3">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold" id="editUserModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form id="editUserForm" method="POST" action="">
                            @csrf
                            @method('PUT')

                            <div class="modal-body pt-2">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Full Name</label>
                                    <input type="text" name="name" class="form-control custom-form-control" id="editName" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control custom-form-control" id="editEmail" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Phone</label>
                                    <input type="text" name="phone" class="form-control custom-form-control" id="editPhone">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Role</label>
                                    <select name="role" class="form-select custom-form-control" id="editRole" required>
                                        <option value="1">Admin</option>
                                        <option value="0">User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer border-0 pt-3">
                                <button type="button" class="btn btn-light custom-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-dark custom-save-btn">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete User Modal -->
            <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content custom-modal-content p-3">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold" id="deleteUserModalLabel">Delete User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form id="deleteUserForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong id="deleteUserNameText"></strong>? This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-light custom-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger custom-delete-btn">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
            @endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    // When the modal is triggered
    const editButtons = document.querySelectorAll('.edit-user-btn');
    const editForm = document.getElementById('editUserForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            const userName = this.getAttribute('data-name');
            const userEmail = this.getAttribute('data-email');
            const userPhone = this.getAttribute('data-phone');
            const userRole = this.getAttribute('data-role');

            // Fill modal input fields
            document.getElementById('editName').value = userName;
            document.getElementById('editEmail').value = userEmail;
            document.getElementById('editPhone').value = userPhone;
            document.getElementById('editRole').value = userRole;

            // Update form action dynamically
            editForm.action = `/admin/users/${userId}`;
        });
    });

    var deleteUserModal = document.getElementById('deleteUserModal');
    deleteUserModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; 
        var userName = button.getAttribute('data-name');
        var userId = button.getAttribute('data-id');

        var modalName = deleteUserModal.querySelector('#deleteUserNameText');
        modalName.textContent = userName;

        var form = deleteUserModal.querySelector('#deleteUserForm');
        form.action = '/admin/users/' + userId; // Update the action dynamically
    });

});
</script>

<style>
   /* ======== MINIMAL CLEAN FORM STYLE (No Shadow, No Underline) ======== */

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


/* Remove default blue active background for dropdown items */
.dropdown-item:active,
.dropdown-item:focus {
    background-color: #f0f0f0 !important; /* light gray or any color you like */
    color: inherit !important;
    box-shadow: none !important;
}

/* Optional: smooth hover effect */
.dropdown-item:hover {
    background-color: #e9ecef !important; /* slightly darker on hover */
    color: inherit !important;
}

</style>