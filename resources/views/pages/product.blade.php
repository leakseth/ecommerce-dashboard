

@extends('layouts.app')

@section('title', 'Product')
@php 
    use Illuminate\Support\Str; 
@endphp
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-2">Product Management</h2>
        <small class="text-muted">Manage your product inventory and details</small>
    </div>
    <button type="button" class="btn btn-dark rounded-2 px-4" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="bi bi-plus-lg"></i> Add Product
    </button>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Product could not be saved. Please check the form errors.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="card border-0 shadow-sm px-4 py-0"  style="max-height: 630px;  overflow-y: auto;">
    <table class="table align-middle table-hover mb-0 ">
        <thead class="table-light sticky-top">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset('storage/'.$product->image) }}" class="rounded" style="  object-fit: cover; width: 70px; height:auto;"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 30) }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>

                        @php
                            $stock = $product->stock;
                            $badgeClass = $stock > 10 ? 'bg-success text-light' : ($stock > 0 ? 'bg-warning text-dark' : 'bg-danger');
                            $status = $stock > 10 ? 'In Stock' : ($stock > 0 ? 'Low Stock' : 'Out of Stock');
                        @endphp

                        <span class="badge {{ $badgeClass }}">
                            {{ $product->status }}
                        </span>
                    </td>
                    <td> 
                        <button 
                            type="button" 
                            class="btn btn-outline-dark btn-sm edit-product-btn"
                            data-bs-toggle="modal" 
                            data-bs-target="#editProductModal"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-category="{{ $product->category_id }}"
                            data-price="{{ $product->price }}"
                            data-stock="{{ $product->stock }}"
                            data-status="{{ $product->status }}"
                            data-description="{{ $product->description }}"
                            data-image="{{ asset('storage/'.$product->image) }}">
                            <i class="bi bi-pencil"></i>
                        </button>
        
                        
                        <button type="button" class="btn btn-outline-danger btn-sm delete-product-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteProductModal"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                        >
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>

</div>


<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content custom-modal-content p-3"> 
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addProductLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-2">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Product Image</label>
                            <input type="file" name="image" class="form-control custom-form-control" id="addProductImageInput" accept="image/*" required>
                            <div class="col-12">
                                <label class="form-label fw-bold form-label-custom">Description</label>
                                <textarea name="description" class="form-control custom-form-control" rows="3" placeholder="Enter product description"></textarea>
                            </div>

                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <img id="addImagePreview" src="https://shop.songprinting.com/global/images/PublicShop/ProductSearch/prodgr_default_300.png" alt="Preview" 
                                class="rounded" style="width:250px; height:200px; object-fit:cover; border: dashed 2px #ccc;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Product Name</label>
                            <input type="text" name="name" class="form-control custom-form-control" placeholder="Enter product name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Category</label>
                            <select name="category_id" class="form-select custom-form-control" required>
                                <option disabled selected>Select category</option>
                                @isset($categories)
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                @endisset
                                
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control custom-form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Stock</label>
                            <input type="number" name="stock" class="form-control custom-form-control" required>
                        </div>

                        <!-- <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Status</label>
                            <select name="status" class="form-select custom-form-control" required>
                                <option value="in_stock">In Stock</option>
                                <option value="low_stock">Low Stock</option>
                                <option value="out_of_stock">Out of Stock</option>
                            </select>
                        </div> -->
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


<!-- EDIT PRODUCT MODAL -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content custom-modal-content p-3"> 
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="editProductLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Form action will be set dynamically via JS -->
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body pt-2">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Product Image (Leave blank to keep current)</label>
                            <input type="file" name="image" class="form-control custom-form-control" id="editProductImageInput" accept="image/*">
                            <div class="col-12">
                                <label class="form-label fw-bold form-label-custom">Description</label>
                                <textarea name="description" id="editProductDescription" class="form-control custom-form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <img id="editImagePreview" src="https://via.placeholder.com/120?text=Current" alt="Current Image" 
                                class="rounded" style="width:250px; height:200px; object-fit:cover; border: dashed 2px #ccc;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Product Name</label>
                            <input type="text" name="name" id="editProductName" class="form-control custom-form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Category</label>
                            <select name="category" class="form-select custom-form-control" id="editProductCategory" required>
                                @isset($categories)
                                    @foreach ($categories as $category)
                                         <option value="{{ $category->id }}" >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Price ($)</label>
                            <input type="number" step="0.01" name="price" id="editProductPrice" class="form-control custom-form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Stock</label>
                            <input type="number" name="stock" id="editProductStock" class="form-control custom-form-control" required>
                        </div>

                        <!-- <div class="col-md-6">
                            <label class="form-label fw-bold form-label-custom">Status</label>
                            <select name="status" class="form-select custom-form-control" id="editProductStatus" required>
                                <option value="in_stock">In Stock</option>
                                <option value="low_stock">Low Stock</option>
                                <option value="out_of_stock">Out of Stock</option>
                            </select>
                        </div> -->
                    </div>
                </div>

                <div class="modal-footer border-0 pt-3">
                    <button type="button" class="btn btn-light custom-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark custom-save-btn rounded-2">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>  


<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="deleteProductLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @foreach ($products as $product)
                <form action="{{ url('admin/products/'.$product->id) }}" id="deleteProductForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure you want to delete 
                            <strong id="deleteProductNameText">
                                {{$product->name}}
                            </strong>? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            @endforeach
            
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    
    const addImageInput = document.getElementById('addProductImageInput');
    const addPreview = document.getElementById('addImagePreview');

    if (addImageInput) {
        addImageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    addPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                addPreview.src = "https://via.placeholder.com/120?text=Preview";
            }
        });
    }
    
    // Base URL for products (matches route: /admin/products/{id})
    const baseUrl = "{{ url('/admin/products') }}"; 

    const editModal = document.getElementById('editProductModal');

    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const productCategory = button.getAttribute('data-category');
            const productPrice = button.getAttribute('data-price');
            const productStock = button.getAttribute('data-stock');
            const productImage = button.getAttribute('data-image');
            const productDescription = button.getAttribute('data-description');

            const form = document.getElementById('editProductForm');
            form.action = `${baseUrl}/${productId}`; // ✅ Correct PUT URL

            document.getElementById('editProductName').value = productName;
            document.getElementById('editProductPrice').value = productPrice;
            document.getElementById('editProductStock').value = productStock;
            document.getElementById('editProductCategory').value = productCategory;
            document.getElementById('editProductDescription').value = productDescription || '';

            const imagePreview = document.getElementById('editImagePreview');
            imagePreview.src = productImage ? productImage : "https://via.placeholder.com/120?text=No+Image";

            const editImageInput = document.getElementById('editProductImageInput');
            editImageInput.value = ''; // clear file input
            editImageInput.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (ev) {
                        imagePreview.src = ev.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            };
        });
    }

    const deleteButtons = document.querySelectorAll('.delete-product-btn');
    const deleteNameText = document.getElementById('deleteProductNameText');
    const deleteForm = document.getElementById('deleteProductForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');

            // បង្ហាញឈ្មោះក្នុង modal
            deleteNameText.textContent = productName;

            // កំណត់ action URL (ឧទាហរណ៍: /admin/products/3)
            deleteForm.action = `/admin/products/${productId}`;
        });
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

</style>