@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2 class="fw-bold mb-2 header-text">Welcome to Dashboard</h2>
<p class="text-muted mb-4 subheader-text">Welcome back! Here's what's happening today.</p>

<div style="max-height: 630px; padding: 0px;">
    <div class="row g-4 mb-5">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 dashboard-metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold text-secondary mb-3 dashboard-card-title">Total Products</h6>
                        <h3 class="fw-bold mb-0 dashboard-card-value">{{ $totalProducts }}</h3>
                    </div>
                    <div class="bg-light p-3 rounded-circle dashboard-icon-circle">
                        <i class="bi bi-box-seam fs-4 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 dashboard-metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold text-secondary mb-3 dashboard-card-title">Total Users</h6>
                        <h3 class="fw-bold mb-0 dashboard-card-value">{{ $totalUsers }}</h3>
                    </div>
                    <div class="bg-light p-3 rounded-circle dashboard-icon-circle">
                        <i class="bi bi-people fs-4 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 dashboard-metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold text-secondary mb-3 dashboard-card-title">Revenue</h6>
                        <h3 class="fw-bold mb-0 dashboard-card-value">${{ number_format($revenue, 2) }}</h3>
                    </div>
                    <div class="bg-light p-3 rounded-circle dashboard-icon-circle">
                        <i class="bi bi-currency-dollar fs-4 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 dashboard-metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold text-secondary mb-3 dashboard-card-title">Pending Orders</h6>
                        <h3 class="fw-bold mb-0 dashboard-card-value">{{ $pendingOrders }}</h3>
                    </div>
                    <div class="bg-light p-3 rounded-circle dashboard-icon-circle">
                        <i class="bi bi-clock-history fs-4 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold card-title-dark">Sales Performance (Last 6 Months)</h5>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="salesChart"></canvas>
                    <!-- <div class="d-flex justify-content-center align-items-center h-100 text-muted border rounded p-4 chart-placeholder">
                        <p class="m-0">📊 Chart Placeholder: Implement Chart.js or ApexCharts here.</p>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="col-lg-5" style="height: 400px;">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold card-title-dark mb-4">Top Selling Products</h5>
                <ul class="list-group list-group-flush recent-list">
                    @foreach($topProducts as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-center ps-0">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-box-seam me-3 fs-5 text-dark"></i>
                            <span class="fw-medium">{{ $product['name'] }}</span>
                        </div>
                        <span class="badge bg-secondary-subtle text-dark p-2">{{ number_format($product['sold']) }} sold</span>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('salesChart');
    const labels = @json($months);
    const salesData = @json($salesData);

    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue ($)',
                    data: salesData,
                    borderColor: '#000000',
                    backgroundColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#000000',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '$' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: false,
                        grid: { color: '#e9ecef' },
                        ticks: {
                            callback: function(value) { return '$' + value.toLocaleString(); }
                        }
                    }
                }
            }
        });
    }
});
</script>


@endsection