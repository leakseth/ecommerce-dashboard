@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="">
    <header class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold header-text">Categories</h1>
            <p class="text-muted subheader-text">Organize and manage your product categories.</p>
        </div>
        <button class="btn btn-dark add-user-btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-plus me-2"></i> Add Category
        </button>
    </header>

    <div class="card border p-3">
    <div class="table-responsive">
        <table class="table align-middle table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Total Products</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr id="category-{{ $category->id }}">
                    <td>{{ $category->id }}</td>
                    <td class="fw-medium">{{ $category->name }}</td>
                    <td>
                        <span class="badge bg-dark fw-bold p-2">{{ $category->total_products }}</span>
                    </td>
                    <td class="text-muted">{{ $category->updated_at->format('Y-m-d') }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-secondary me-2 edit-category-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#editCategoryModal"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger delete-category-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteCategoryModal"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content custom-modal-content p-3">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="addCategoryLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body pt-2">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label fw-bold form-label-custom">Category Name</label>
                            <input name="name" type="text" class="form-control custom-form-control" id="categoryName" placeholder="e.g., Electronics" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-3">
                        <button type="button" class="btn btn-light custom-cancel-btn me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark custom-save-btn rounded-2">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content custom-modal-content p-3">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="editCategoryLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body pt-2">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label fw-bold form-label-custom">Category Name</label>
                            <input type="text" class="form-control custom-form-control" id="editCategoryName" name="name" value="" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-3">
                        <button type="button" class="btn btn-light custom-cancel-btn me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark custom-save-btn rounded-2">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteCategoryLabel">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="deleteCategoryForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure you want to delete the category: <strong id="deleteCategoryNameText"></strong>? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Edit Modal
    const editModal = document.getElementById('editCategoryModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const categoryId = button.getAttribute('data-id');
            const categoryName = button.getAttribute('data-name');

            const form = document.getElementById('editCategoryForm');
            // 👇 CORRECTION: Must include '/admin' prefix
            form.action = `/admin/categories/${categoryId}`; 
            document.getElementById('editCategoryName').value = categoryName;
        });
    }

    // Delete Modal
    const deleteModal = document.getElementById('deleteCategoryModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const categoryId = button.getAttribute('data-id');
            const categoryName = button.getAttribute('data-name');

            document.getElementById('deleteCategoryNameText').textContent = categoryName;
            const form = document.getElementById('deleteCategoryForm');
            // 👇 CORRECTION: Must include '/admin' prefix
            form.action = `/admin/categories/${categoryId}`; 
        });
    }
});
</script>

<style>
    /* ======== MINIMAL CLEAN FORM STYLE FOR CATEGORY MODALS ======== */

/* General input style */
.custom-form-control {
  box-shadow: none !important;
  border: 1px solid #ddd !important;
  border-radius: 8px !important;
  background-color: #fafafa !important;
  transition: all 0.3s ease;
}

/* On focus — slightly darker border and white background */
.custom-form-control:focus {
  border-color: #333 !important;
  background-color: #fff !important;
  box-shadow: none !important;
  outline: none !important;
}

/* Labels */
.form-label-custom {
  font-weight: 600;
  color: #333;
  margin-bottom: 4px;
}

/* Modal content — no shadow */
.custom-modal-content {
  border: none !important;
  box-shadow: none !important;
  border-radius: 12px !important;
  background-color: #fff !important;
}

/* Buttons — flat and clean */
.custom-cancel-btn,
.custom-save-btn {
  box-shadow: none !important;
  border-radius: 6px !important;
}

/* Optional subtle hover effect for input */
.custom-form-control:hover {
  border-color: #999 !important;
}

/* Placeholder color */
::placeholder {
  color: #aaa !important;
  opacity: 0.9;
}

</style>
@endsection

