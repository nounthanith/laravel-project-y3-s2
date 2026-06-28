@extends('layouts.app')

@section('title', 'Delivery ' . $delivery->tracking_number)

@section('content')
<!-- @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif -->

<div class="mb-3">
    <a href="{{ route('deliveries.index') }}" class="btn btn-outline-dark btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-truck me-2"></i>Delivery Details</h5>
                <span class="badge bg-{{ $delivery->status === 'delivered' ? 'success' : ($delivery->status === 'cancelled' ? 'danger' : ($delivery->status === 'in_transit' ? 'info' : ($delivery->status === 'picked_up' ? 'warning' : 'secondary'))) }} fs-6">
                    {{ str_replace('_', ' ', ucfirst($delivery->status)) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-muted mb-0"><small>Tracking Number</small></p>
                        <p class="fs-5 fw-bold"><code>{{ $delivery->tracking_number }}</code></p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-0"><small>Created</small></p>
                        <p>{{ $delivery->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="text-primary"><i class="bi bi-person-up me-1"></i>Sender</h6>
                            <p class="mb-1"><strong>{{ $delivery->sender_name }}</strong></p>
                            <p class="mb-1">{{ $delivery->sender_phone }}</p>
                            <p class="mb-0"><small class="text-muted">From:</small><br>{{ $delivery->sender_address }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="text-success"><i class="bi bi-person-down me-1"></i>Receiver</h6>
                            <p class="mb-1"><strong>{{ $delivery->receiver_name }}</strong></p>
                            <p class="mb-1">{{ $delivery->receiver_phone }}</p>
                            <p class="mb-0"><small class="text-muted">To:</small><br>{{ $delivery->receiver_address }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <p class="text-muted mb-0"><small>Package Type</small></p>
                        <p>{{ ucfirst($delivery->package_type) }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <p class="text-muted mb-0"><small>Weight</small></p>
                        <p>{{ $delivery->weight ? $delivery->weight . ' kg' : 'N/A' }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <p class="text-muted mb-0"><small>Est. Delivery</small></p>
                        <p>{{ $delivery->estimated_delivery ? date('F d, Y', strtotime($delivery->estimated_delivery)) : 'N/A' }}</p>
                    </div>
                </div>

                @if ($delivery->description)
                    <div class="mb-3">
                        <p class="text-muted mb-0"><small>Description</small></p>
                        <p>{{ $delivery->description }}</p>
                    </div>
                @endif

                @if ($delivery->notes)
                    <div class="mb-3">
                        <p class="text-muted mb-0"><small>Notes</small></p>
                        <p>{{ $delivery->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>Payment</h5>
            </div>
            <div class="card-body">
                <h3 class="text-center">₱{{ number_format($delivery->delivery_fee, 2) }}</h3>
                <p class="text-muted text-center mb-0">Delivery Fee</p>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Update Status</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('deliveries.update-status', $delivery) }}">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select mb-3" required>
                        <option value="pending" {{ $delivery->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="picked_up" {{ $delivery->status === 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                        <option value="in_transit" {{ $delivery->status === 'in_transit' ? 'selected' : '' }}>In Transit</option>
                        <option value="delivered" {{ $delivery->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $delivery->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-arrow-repeat me-1"></i>Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Status Timeline</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        Order Created<br>
                        <small class="text-muted">{{ $delivery->created_at->format('M d, Y h:i A') }}</small>
                    </li>
                    @if (in_array($delivery->status, ['picked_up', 'in_transit', 'delivered']))
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Picked Up
                        </li>
                    @endif
                    @if (in_array($delivery->status, ['in_transit', 'delivered']))
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            In Transit
                        </li>
                    @endif
                    @if ($delivery->status === 'delivered')
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Delivered
                        </li>
                    @endif
                    @if ($delivery->status === 'cancelled')
                        <li class="mb-2">
                            <i class="bi bi-x-circle-fill text-danger me-2"></i>
                            Cancelled
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
