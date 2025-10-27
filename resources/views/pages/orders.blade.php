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
                            <a href="{{ route('orders.show', $order->id) }}" 
                               class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-eye"></i>
                            </a>

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
