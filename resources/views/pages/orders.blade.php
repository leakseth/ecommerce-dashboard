@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="p-4">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold header-text">Order History</h1>
            <p class="text-muted subheader-text">View and manage all customer orders.</p>
        </div>
        <button class="btn btn-outline-dark add-user-btn">
            <i class="bi bi-file-earmark-arrow-down me-2"></i> Export Report
        </button>
    </header>

    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" class="form-control custom-form-control" placeholder="Search by Order ID or Customer Name">
        </div>
        <div class="col-md-3">
            <select class="form-select custom-form-control">
                <option selected>Filter by Status</option>
                <option value="Delivered">Delivered</option>
                <option value="Processing">Processing</option>
                <option value="Shipped">Shipped</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle recent-orders-table">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th> </tr>
                </thead>
                <tbody>
                    <tr data-bs-toggle="modal" data-bs-target="#orderDetailModal" style="cursor: pointer;">
                        <td>#ORD9001</td>
                        <td class="fw-medium">Jane Doe</td>
                        <td>2025-10-09</td>
                        <td>$129.50</td>
                        <td><span class="badge bg-success p-2">Delivered</span></td>
                        <td><i class="bi bi-eye text-muted"></i></td>
                    </tr>
                    <tr data-bs-toggle="modal" data-bs-target="#orderDetailModal" style="cursor: pointer;">
                        <td>#ORD9002</td>
                        <td class="fw-medium">Mike Johnson</td>
                        <td>2025-10-09</td>
                        <td>$45.00</td>
                        <td><span class="badge bg-warning text-dark p-2">Processing</span></td>
                        <td><i class="bi bi-eye text-muted"></i></td>
                    </tr>
                    <tr data-bs-toggle="modal" data-bs-target="#orderDetailModal" style="cursor: pointer;">
                        <td>#ORD9003</td>
                        <td class="fw-medium">Sarah Lee</td>
                        <td>2025-10-08</td>
                        <td>$350.99</td>
                        <td><span class="badge bg-info text-dark p-2">Shipped</span></td>
                        <td><i class="bi bi-eye text-muted"></i></td>
                    </tr>
                    <tr data-bs-toggle="modal" data-bs-target="#orderDetailModal" style="cursor: pointer;">
                        <td>#ORD9004</td>
                        <td class="fw-medium">David Kim</td>
                        <td>2025-10-08</td>
                        <td>$15.00</td>
                        <td><span class="badge bg-danger p-2">Cancelled</span></td>
                        <td><i class="bi bi-eye text-muted"></i></td>
                    </tr>
                    </tbody>
            </table>
        </div>
        
    </div>

    <div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content custom-modal-content p-3">
                <div class="modal-header border-0 pb-0">
                    <h4 class="modal-title fw-bold" id="orderDetailLabel">Order #ORD9001 Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body pt-2">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
                        <div>
                            <span class="text-muted me-2 fw-medium">Status:</span>
                            <span class="badge bg-success fs-6 p-2">Delivered</span>
                        </div>
                        <div>
                            <button class="btn btn-outline-dark btn-sm me-2"><i class="bi bi-printer me-1"></i> Print Invoice</button>
                            <button class="btn btn-dark btn-sm"><i class="bi bi-send me-1"></i> Update Status</button>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Customer Information</h6>
                            <p class="mb-1"><strong class="text-dark">Customer:</strong> Jane Doe</p>
                            <p class="mb-1"><strong class="text-dark">Email:</strong> jane.doe@example.com</p>
                            <p class="mb-1"><strong class="text-dark">Phone:</strong> +1 555-1234</p>
                            <p class="mb-1"><strong class="text-dark">Shipping:</strong> 123 Main St, Apt 4B, Anytown, 10001</p>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Summary</h6>
                            <p class="mb-1"><strong class="text-dark">Order Date:</strong> 2025-10-09</p>
                            <p class="mb-1"><strong class="text-dark">Payment Method:</strong> Visa ending in 4242</p>
                            <p class="mb-1"><strong class="text-dark">Shipping Method:</strong> Standard (3-5 days)</p>
                            <p class="mb-1"><strong class="text-dark">Total Items:</strong> 2</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold mb-3">Items Ordered</h6>
                    <ul class="list-group list-group-flush border rounded-2 mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-medium">Wireless Headphones</span> <span class="text-muted small">x 1</span>
                            </div>
                            <span class="fw-bold">$99.50</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-medium">Fast Charger Cable</span> <span class="text-muted small">x 1</span>
                            </div>
                            <span class="fw-bold">$30.00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-end pt-3">
                            <div style="width: 250px;">
                                <div class="d-flex justify-content-between text-muted small">
                                    <span>Subtotal:</span>
                                    <span>$129.50</span>
                                </div>
                                <div class="d-flex justify-content-between text-muted small">
                                    <span>Shipping:</span>
                                    <span>$0.00</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-5 pt-1">
                                    <span>Total:</span>
                                    <span>$129.50</span>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
                
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light custom-cancel-btn" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection