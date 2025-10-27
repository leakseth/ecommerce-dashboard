@extends('layouts.app')

@section('title', 'Orders Management')

@section('content')
<div class="">
    <!-- Header Section -->
    <header class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold header-text">Orders Management</h1>
            <p class="text-muted subheader-text">View and manage all customer orders efficiently.</p>
        </div>
    </header>

    @if($orders->isEmpty())
        <p class="text-center text-muted mt-4">No orders found.</p>
    @else

    <div class="card border p-3">
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Order Number</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Placed At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr id="order-{{ $order->id }}">
                        <td>{{ $loop->iteration + ($orders->currentPage()-1)*$orders->perPage() }}</td>
                        <td class="fw-medium">{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td><span class="fw-bold text-dark">${{ number_format($order->total, 2) }}</span></td>

                        <td id="order-status-{{ $order->id }}">
                            <span class="badge 
                                {{ $order->status == 'pending' ? 'bg-warning text-dark' : ($order->status == 'ordered' ? 'bg-success' : 'bg-danger') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <button
                               class="btn btn-sm btn-outline-primary me-2 view-order"
                            data-order="{{ json_encode($order->load('orderItems.product')) }}">
                                <i class="bi bi-eye"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-secondary me-2 edit-order-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editOrderModal"
                                data-id="{{ $order->id }}"
                                data-status="{{ $order->status }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 text-center">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<!-- Order Detail Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="orderModalLabel">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="orderDetailsContent">
            <p class="text-center text-muted">Loading...</p>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content custom-modal-content p-3">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="editOrderLabel">Update Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editOrderForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body pt-2">
                    <div class="mb-3">
                        <label for="orderStatus" class="form-label fw-bold form-label-custom">Select Status</label>
                        <select name="status" id="orderStatus" class="form-select custom-form-control" required>
                            <option value="pending">Pending</option>
                            <option value="ordered">Ordered</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-3">
                    <button type="button" class="btn btn-light custom-cancel-btn me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark custom-save-btn rounded-2">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editOrderModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const orderId = button.getAttribute('data-id');
            const currentStatus = button.getAttribute('data-status');

            const form = document.getElementById('editOrderForm');
            form.action = `/admin/orders/${orderId}/update-status`;

            // Set current status selected
            document.getElementById('orderStatus').value = currentStatus;
        });
    }

    // 

    const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
    const orderDetailsContent = document.getElementById('orderDetailsContent');

    document.querySelectorAll('.view-order').forEach(button => {
        button.addEventListener('click', function() {
            const order = JSON.parse(this.dataset.order);

            let html = `
                <p><strong>Order #:</strong> ${order.order_number}</p>
                <p><strong>User:</strong> ${order.user.name}</p>
                <p><strong>Total:</strong> $${parseFloat(order.total).toFixed(2)}</p>
                <p><strong>Status:</strong> ${order.status.charAt(0).toUpperCase() + order.status.slice(1)}</p>
                <p><strong>Payment Method:</strong> ${order.payment_method}</p>
                <p><strong>Address:</strong> ${order.shipping_address ?? 'N/A'}</p>

                <h5 class="mt-3">Order Items</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            order.order_items.forEach(item => {
                html += `
                    <tr>
                        <td>${item.product ? item.product.name : 'Deleted Product'}</td>
                        <td>${item.quantity}</td>
                        <td>$${parseFloat(item.price).toFixed(2)}</td>
                        <td>$${(item.price * item.quantity).toFixed(2)}</td>
                    </tr>
                `;
            });

            html += `
                    </tbody>
                </table>
            `;

            orderDetailsContent.innerHTML = html;
            orderModal.show();
        });
    });
});
</script>

<style>

.custom-form-control {
  box-shadow: none !important;
  border: 1px solid #ddd !important;
  border-radius: 8px !important;
  background-color: #fafafa !important;
  transition: all 0.3s ease;
}

.custom-form-control:focus {
  border-color: #333 !important;
  background-color: #fff !important;
  box-shadow: none !important;
  outline: none !important;
}

.form-label-custom {
  font-weight: 600;
  color: #333;
  margin-bottom: 4px;
}

.custom-modal-content {
  border: none !important;
  box-shadow: none !important;
  border-radius: 12px !important;
  background-color: #fff !important;
}

.custom-cancel-btn,
.custom-save-btn {
  box-shadow: none !important;
  border-radius: 6px !important;
}

.custom-form-control:hover {
  border-color: #999 !important;
}

::placeholder {
  color: #aaa !important;
  opacity: 0.9;
}
</style>
@endsection
