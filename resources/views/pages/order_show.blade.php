@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Order #{{ $order->order_number }}</h2>

    <div class="mb-3">
        <p><strong>User:</strong> {{ $order->user->name }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
        <p><strong>Address:</strong> {{ $order->shipping_address ?? 'N/A' }}</p>
    </div>

    <h4>Order Items</h4>
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
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
