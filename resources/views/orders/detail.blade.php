@extends('layouts.user')

@section('title', 'Order Details')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Order Details: {{ $order->order_number }}</h2>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Order Items</h5>
            <ul class="list-group list-group-flush">
                @foreach($order->orderItems as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $item->product->name ?? 'Deleted Product' }}</strong>
                        <div class="text-muted small">Qty: {{ $item->quantity }}</div>
                    </div>
                    <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                </li>
                @endforeach
            </ul>
            <hr>
            <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total:</span>
                <span>${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

    <a href="{{ route('orders.history') }}" class="btn btn-outline-dark">Back to Orders</a>
</div>
@endsection
