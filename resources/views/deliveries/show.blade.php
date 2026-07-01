@extends('layouts.app')

@section('title', __('messages.delivery_order') . ' ' . $delivery->tracking_number)

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('deliveries.index') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i>{{ __('messages.back') }}
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-truck me-2"></i>{{ __('messages.delivery_order') }}</h5>
                    <span
                        class="badge bg-{{ $delivery->status === 'delivered' ? 'success' : ($delivery->status === 'cancelled' ? 'danger' : ($delivery->status === 'in_transit' ? 'info' : ($delivery->status === 'picked_up' ? 'warning' : 'secondary'))) }} fs-6">
                        {{ __("messages.{$delivery->status}") }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-0"><small>{{ __('messages.tracking_number') }}</small></p>
                            <p class="fs-5 fw-bold"><code>{{ $delivery->tracking_number }}</code></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-0"><small>{{ __('messages.created') }}</small></p>
                            <p>{{ $delivery->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h6 class="text-primary"><i class="bi bi-person-up me-1"></i>{{ __('messages.sender') }}
                                </h6>
                                <p class="mb-1"><strong>{{ $delivery->sender_name }}</strong></p>
                                <p class="mb-1">{{ $delivery->sender_phone }}</p>
                                <p class="mb-0"><small
                                        class="text-muted">{{ __('messages.from') }}:</small><br>{{ $delivery->sender_address }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h6 class="text-success"><i class="bi bi-person-down me-1"></i>{{ __('messages.receiver') }}
                                </h6>
                                <p class="mb-1"><strong>{{ $delivery->receiver_name }}</strong></p>
                                <p class="mb-1">{{ $delivery->receiver_phone }}</p>
                                <p class="mb-0"><small
                                        class="text-muted">{{ __('messages.to') }}:</small><br>{{ $delivery->receiver_address }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <p class="text-muted mb-0"><small>{{ __('messages.package_type') }}</small></p>
                            <p>{{ __("messages.{$delivery->package_type}") }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="text-muted mb-0"><small>{{ __('messages.weight') }}</small></p>
                            <p>{{ $delivery->weight ? $delivery->weight . ' kg' : 'N/A' }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="text-muted mb-0"><small>{{ __('messages.est_delivery') }}</small></p>
                            <p>{{ $delivery->estimated_delivery ? date('F d, Y', strtotime($delivery->estimated_delivery)) : 'N/A' }}
                            </p>
                        </div>
                    </div>

                    @if ($delivery->description)
                        <div class="mb-3">
                            <p class="text-muted mb-0"><small>{{ __('messages.description') }}</small></p>
                            <p>{{ $delivery->description }}</p>
                        </div>
                    @endif

                    @if ($delivery->notes)
                        <div class="mb-3">
                            <p class="text-muted mb-0"><small>{{ __('messages.notes') }}</small></p>
                            <p>{{ $delivery->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>{{ __('messages.payment') }}</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-center">${{ number_format($delivery->delivery_fee, 2) }}</h3>
                    <p class="text-muted text-center mb-0">{{ __('messages.delivery_fee') }}</p>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>{{ __('messages.update_status') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('deliveries.update-status', $delivery) }}">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select mb-3" required>
                            <option value="pending" {{ $delivery->status === 'pending' ? 'selected' : '' }}>
                                {{ __('messages.pending') }}</option>
                            <option value="picked_up" {{ $delivery->status === 'picked_up' ? 'selected' : '' }}>
                                {{ __('messages.picked_up') }}</option>
                            <option value="in_transit" {{ $delivery->status === 'in_transit' ? 'selected' : '' }}>
                                {{ __('messages.in_transit') }}</option>
                            <option value="delivered" {{ $delivery->status === 'delivered' ? 'selected' : '' }}>
                                {{ __('messages.delivered') }}</option>
                            <option value="cancelled" {{ $delivery->status === 'cancelled' ? 'selected' : '' }}>
                                {{ __('messages.cancelled') }}</option>
                        </select>
                        <button type="submit" class="btn btn-dark w-100">
                            <i class="bi bi-arrow-repeat me-1"></i>{{ __('messages.update_status') }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>{{ __('messages.status_timeline') }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            {{ __('messages.order_created') }}<br>
                            <small class="text-muted">{{ $delivery->created_at->format('M d, Y h:i A') }}</small>
                        </li>
                        @if (in_array($delivery->status, ['picked_up', 'in_transit', 'delivered']))
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                {{ __('messages.picked_up') }}
                            </li>
                        @endif
                        @if (in_array($delivery->status, ['in_transit', 'delivered']))
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                {{ __('messages.in_transit') }}
                            </li>
                        @endif
                        @if ($delivery->status === 'delivered')
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                {{ __('messages.delivered') }}
                            </li>
                        @endif
                        @if ($delivery->status === 'cancelled')
                            <li class="mb-2">
                                <i class="bi bi-x-circle-fill text-danger me-2"></i>
                                {{ __('messages.cancelled') }}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection