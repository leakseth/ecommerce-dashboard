@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2 class="fw-bold mb-2 header-text">Welcome to Dashboard</h2>
<p class="text-muted mb-4 subheader-text">Welcome back! Here's what's happening today.</p>

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
        <div class="card border-0 shadow-sm h-100 p-4">
            <h5 class="fw-bold card-title-dark">Sales Performance (Last 6 Months)</h5>
            <div class="chart-container" style="height: 300px;">
                <canvas id="salesChart"></canvas>
                <!-- <div class="d-flex justify-content-center align-items-center h-100 text-muted border rounded p-4 chart-placeholder">
                    <p class="m-0">📊 Chart Placeholder: Implement Chart.js or ApexCharts here.</p>
                </div> -->
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100 p-4">
            <h5 class="fw-bold card-title-dark mb-4">Top Selling Products</h5>
            <ul class="list-group list-group-flush recent-list">
                <li class="list-group-item d-flex justify-content-between align-items-center ps-0">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-headset me-3 fs-5 text-dark"></i>
                        <span class="fw-medium">Wireless Headphones</span>
                    </div>
                    <span class="badge bg-secondary-subtle text-dark p-2">1,500 sold</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ps-0">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-usb-plug me-3 fs-5 text-dark"></i>
                        <span class="fw-medium">Fast Charger Cable</span>
                    </div>
                    <span class="badge bg-secondary-subtle text-dark p-2">1,210 sold</span>
                </li>
                 <li class="list-group-item d-flex justify-content-between align-items-center ps-0">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-mouse me-3 fs-5 text-dark"></i>
                        <span class="fw-medium">Ergonomic Mouse</span>
                    </div>
                    <span class="badge bg-secondary-subtle text-dark p-2">980 sold</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ps-0">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-tablet me-3 fs-5 text-dark"></i>
                        <span class="fw-medium">10-inch Tablet Case</span>
                    </div>
                    <span class="badge bg-secondary-subtle text-dark p-2">755 sold</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('salesChart');

    // Sample Data (Replace with your actual data from the backend)
    const labels = ['Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'];
    const salesData = [15000, 22000, 18000, 25000, 31000, 28000];

    if (ctx) {
        // Hide the placeholder div once the chart is ready to render
        const placeholder = ctx.parentNode.querySelector('.chart-placeholder');
        if (placeholder) {
            placeholder.style.display = 'none';
        }

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue ($)',
                    data: salesData,
                    // Styling for a modern, clean look
                    borderColor: '#000000', // Black line
                    backgroundColor: 'rgba(0, 0, 0, 0.1)', // Light fill color
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#000000',
                    tension: 0.4, // Smooth curved line
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Hide legend to keep it clean
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        // Custom callback for dollar formatting in tooltip
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false // Hide vertical grid lines
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: '#e9ecef' // Use light Bootstrap gray for horizontal grid
                        },
                        ticks: {
                            // Custom callback for dollar formatting on the Y-axis
                            callback: function(value, index, values) {
                                return '$' + value.toLocaleString();
                            },
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>

@endsection