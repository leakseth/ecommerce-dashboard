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

            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card user-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="initials-circle bg-light text-dark fw-bold">JS</div>
                            <div class="dropdown">
                                <button class="btn btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a 
                                            class="dropdown-item" 
                                            href="#" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal"
                                            data-user-id="1"         data-user-name="Jane Smith"
                                            onclick="loadUserData(this)" >
                                            Edit
                                        </a>
                                    </li>
                                    <li><a data-bs-target="#deleteUserModal" data-bs-toggle="modal" class="dropdown-item text-danger" href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>

                        <h5 class="card-title fw-bold">Jane Smith</h5>
                        <span class="badge role-badge role-manager mb-3">Manager</span>

                        <div class="contact-info mb-2">
                            <i class="fas fa-envelope me-2 text-muted icon-size"></i>
                            <a href="mailto:jane@example.com" class="text-decoration-none contact-text">jane@example.com</a>
                        </div>
                        <div class="contact-info mb-3">
                            <i class="fas fa-phone me-2 text-muted icon-size"></i>
                            <span class="contact-text">+1 234 567 8901</span>
                        </div>

                        <span class="badge status-badge status-active">Active</span>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card user-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="initials-circle bg-light text-dark fw-bold">BJ</div>
                            <div class="dropdown">
                                <button class="btn btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a 
                                            class="dropdown-item" 
                                            href="#" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal"
                                            data-user-id="1"         data-user-name="Jane Smith"
                                            onclick="loadUserData(this)" >
                                            Edit
                                        </a>
                                    </li>
                                    <li><a data-bs-target="#deleteUserModal" data-bs-toggle="modal" class="dropdown-item text-danger" href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>

                        <h5 class="card-title fw-bold">Bob Johnson</h5>
                        <span class="badge role-badge role-user mb-3">User</span>

                        <div class="contact-info mb-2">
                            <i class="fas fa-envelope me-2 text-muted icon-size"></i>
                            <a href="mailto:bob@example.com" class="text-decoration-none contact-text">bob@example.com</a>
                        </div>
                        <div class="contact-info mb-3">
                            <i class="fas fa-phone me-2 text-muted icon-size"></i>
                            <span class="contact-text">+1 234 567 8902</span>
                        </div>

                        <span class="badge status-badge status-active">Active</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card user-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="initials-circle bg-light text-dark fw-bold">AB</div>
                            <div class="dropdown">
                                <button class="btn btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a 
                                            class="dropdown-item" 
                                            href="#" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal"
                                            data-user-id="1"         data-user-name="Jane Smith"
                                            onclick="loadUserData(this)" >
                                            Edit
                                        </a>
                                    </li>
                                    <li><a data-bs-target="#deleteUserModal" data-bs-toggle="modal" class="dropdown-item text-danger" href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>

                        <h5 class="card-title fw-bold">Alice Brown</h5>
                        <span class="badge role-badge role-user mb-3">User</span>

                        <div class="contact-info mb-2">
                            <i class="fas fa-envelope me-2 text-muted icon-size"></i>
                            <a href="mailto:alice@example.com" class="text-decoration-none contact-text">alice@example.com</a>
                        </div>
                        <div class="contact-info mb-3">
                            <i class="fas fa-phone me-2 text-muted icon-size"></i>
                            <span class="contact-text">+1 234 567 8903</span>
                        </div>

                        <span class="badge status-badge status-inactive">Inactive</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card user-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="initials-circle bg-light text-dark fw-bold">CW</div>
                            <div class="dropdown">
                                <button class="btn btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a 
                                            class="dropdown-item" 
                                            href="#" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal"
                                            data-user-id="1"         data-user-name="Jane Smith"
                                            onclick="loadUserData(this)" >
                                            Edit
                                        </a>
                                    </li>
                                    <li><a data-bs-target="#deleteUserModal" data-bs-toggle="modal" class="dropdown-item text-danger" href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>

                        <h5 class="card-title fw-bold">Charlie Wilson</h5>
                        <span class="badge role-badge role-manager mb-3">Manager</span>

                        <div class="contact-info mb-2">
                            <i class="fas fa-envelope me-2 text-muted icon-size"></i>
                            <a href="mailto:charlie@example.com" class="text-decoration-none contact-text">charlie@example.com</a>
                        </div>
                        <div class="contact-info mb-3">
                            <i class="fas fa-phone me-2 text-muted icon-size"></i>
                            <span class="contact-text">+1 234 567 8904</span>
                        </div>

                        <span class="badge status-badge status-active">Active</span>
                    </div>
                </div>
            </div>

            <!-- edit -->
             <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-modal-content">
                        <div class="modal-header border-0 pb-0">
                            <h3 class="modal-title fw-bold" id="addUserModalLabel">Add User</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body pt-2">
                            <form id="addUserForm">
                                
                                <div class="mb-3">
                                    <label for="fullName" class="form-label fw-bold">Full Name</label>
                                    <input type="text" class="form-control custom-form-control" id="fullName" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control custom-form-control" id="email" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-bold">Phone</label>
                                    <input type="tel" class="form-control custom-form-control" id="phone" value="">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="role" class="form-label fw-bold">Role</label>
                                    <select class="form-select custom-form-control" id="role">
                                        <option value="manager" selected>Manager</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end pt-3">
                                    <button type="button" class="btn btn-light me-3 custom-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-dark custom-save-btn rounded-2">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- edit -->
             <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-modal-content">
                        <div class="modal-header border-0 pb-0">
                            <h3 class="modal-title fw-bold" id="editUserModalLabel">Edit User</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body pt-2">
                            <form id="editUserForm">
                                
                                <div class="mb-3">
                                    <label for="fullName" class="form-label fw-bold">Full Name</label>
                                    <input type="text" class="form-control custom-form-control" id="fullName" value="Jane Smith">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control custom-form-control" id="email" value="jane@example.com">
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-bold">Phone</label>
                                    <input type="tel" class="form-control custom-form-control" id="phone" value="+1 234 567 8901">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="role" class="form-label fw-bold">Role</label>
                                    <select class="form-select custom-form-control" id="role">
                                        <option value="manager" selected>Manager</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end pt-3">
                                    <button type="button" class="btn btn-light me-3 custom-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-dark custom-save-btn rounded-2">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Product Modal -->
            <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteProductLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>Wireless Headphones</strong>? This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
                </div>
            </div>
            </div>

        </div>
            @endsection