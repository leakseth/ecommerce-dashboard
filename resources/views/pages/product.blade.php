@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="fw-bold mb-2">Product Management</h2>
    <small class="text-muted">Manage your product inventory and details</small>
  </div>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-dark rounded-2 px-4" data-bs-toggle="modal" data-bs-target="#addProductModal">
    <i class="bi bi-plus-lg"></i> Add Product
  </button>
</div>

<table class="table align-middle table-hover border-top">
  <thead class="table-light">
    <tr>
      <th>ID</th>
      <th>Image</th>
      <th>Product Name</th>
      <th>Category</th>
      <th>Price</th>
      <th>Stock</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td><img src="https://cdn-dynmedia-1.microsoft.com/is/image/microsoftcorp/Content-Card-Surface-Pro-AI-11Ed-Sapphire-MC001?resMode=sharp2&op_usm=1.5,0.65,15,0&wid=520&hei=224&qlt=85&fit=constrain" class="rounded" width="60"></td>
      <td>Wireless Headphones</td>
      <td>Electronics</td>
      <td>$99.99</td>
      <td>45</td>
      <td><span class="badge bg-warning-subtle text-warning">In Stock</span></td>
      <td>
        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">
          <i class="bi bi-pencil"></i>
        </button>
        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProductModal"><i class="bi bi-trash"></i></button>
      </td>
    </tr>
  </tbody>
</table>


<!-- ================= ADD PRODUCT MODAL ================= -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content custom-modal-content p-3"> 
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addProductLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-2">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Product Image</label>
                            <input type="file" class="form-control custom-form-control" id="productImageInput" accept="image/*" required>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <img id="imagePreview" src="https://via.placeholder.com/120" alt="Preview" 
                                class="rounded" style="width:200px; height:120px; object-fit:cover; border: dashed 2px #ccc;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Product Name</label>
                            <input type="text" name="name" class="form-control custom-form-control" placeholder="Enter product name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Category</label>
                            <select name="category" class="form-select custom-form-control" required>
                                <option disabled selected>Select category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Home">Home</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold form-label-custom">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control custom-form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold form-label-custom">Stock</label>
                            <input type="number" name="stock" class="form-control custom-form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Status</label>
                            <select name="status" class="form-select custom-form-control" required>
                                <option value="In Stock">In Stock</option>
                                <option value="Low Stock">Low Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-3">
                    <button type="button" class="btn btn-light custom-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark custom-save-btn rounded-2">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ================= EDIT PRODUCT MODAL ================= -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content custom-modal-content p-3"> 
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addProductLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-2">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Product Image</label>
                            <input type="file" class="form-control custom-form-control" id="productImageInput" accept="image/*" required>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <img id="imagePreview" src="https://via.placeholder.com/120" alt="Preview" 
                                class="rounded" style="width:200px; height:120px; object-fit:cover; border: dashed 2px #ccc;">
                        </div>

                      
                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Product Name</label>
                            <input type="text" name="name" class="form-control custom-form-control" placeholder="Enter product name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Category</label>
                            <select name="category" class="form-select custom-form-control" required>
                                <option disabled selected>Select category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Home">Home</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold form-label-custom">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control custom-form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold form-label-custom">Stock</label>
                            <input type="number" name="stock" class="form-control custom-form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Status</label>
                            <select name="status" class="form-select custom-form-control" required>
                                <option value="In Stock">In Stock</option>
                                <option value="Low Stock">Low Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-3">
                    <button type="button" class="btn btn-light custom-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark custom-save-btn rounded-2">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="deleteProductLabel">Delete Product</h5>
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
@endsection

<!-- =============== IMAGE PREVIEW SCRIPT =============== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  
  // ====== Add Product Preview ======
  const addImageInput = document.getElementById('productImageInput');
  const addPreview = document.getElementById('imagePreview');

  if (addImageInput) {
    addImageInput.addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          addPreview.src = e.target.result; // Set the preview to the selected image
        };
        reader.readAsDataURL(file);
      } else {
        addPreview.src = "https://via.placeholder.com/120";
      }
    });
  }

  // ====== Edit Product Preview ======
  const editModal = document.getElementById('editProductModal');

  if (editModal) {
    editModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget; // Button that triggered the modal (if used)
      const currentImage = editModal.querySelector('.edit-preview-img');
      const inputFile = editModal.querySelector('input[name="image"]');

      // When user changes image, show preview
      inputFile.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (ev) {
            currentImage.src = ev.target.result;
          };
          reader.readAsDataURL(file);
        }
      });
    });
  }

});
</script>

