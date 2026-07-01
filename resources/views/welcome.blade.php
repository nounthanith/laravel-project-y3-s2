@extends('layouts.app')

@section('title', __('messages.track_by_phone'))

@section('main-class', 'container py-5')

@section('content')
    <style>
        .status-step {
            text-align: center;
            position: relative;
            padding: 0 4px;
            flex: 1;
        }

        .status-step .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 6px;
            font-size: 18px;
            border: 2px solid #dee2e6;
            background: #fff;
            color: #adb5bd;
            position: relative;
            z-index: 1;
        }

        .status-step.completed .step-icon {
            background: #198754;
            border-color: #198754;
            color: #fff;
        }

        .status-step.active .step-icon {
            background: #fff;
            border-color: #0d6efd;
            color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .2);
        }

        .status-step.active .step-label {
            color: #0d6efd;
            font-weight: 700;
        }

        .status-step.completed .step-label {
            color: #198754;
        }

        .status-step.cancelled .step-icon {
            background: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .status-step.cancelled .step-label {
            color: #dc3545;
        }

        .status-step+.status-step::before {
            content: '';
            position: absolute;
            top: 20px;
            left: calc(-50% + 20px);
            right: calc(50% + 20px);
            height: 2px;
            background: #dee2e6;
            z-index: 0;
        }

        .status-step.completed+.status-step::before {
            background: #198754;
        }

        .status-step.cancelled+.status-step::before {
            background: #dc3545;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold">{{ __('messages.app_name') }}</h1>
                <p class="lead text-muted">{{ __('messages.enter_phone') }}</p>
            </div>

            <form method="GET" action="{{ route('home') }}" class="mb-5">
                <div class="row g-2 justify-content-center">
                    <div class="col-sm-8 col-md-6">
                        <input type="text" name="phone" class="form-control form-control-lg"
                            placeholder="{{ __('messages.phone_number') }}" value="{{ old('phone', $phone ?? '') }}"
                            required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-dark btn-lg px-4">
                            <i class="bi bi-search me-1"></i>{{ __('messages.search') }}
                        </button>
                    </div>
                </div>
            </form>

            @if ($phone)
                <hr class="my-4">

                <h4 class="mb-3">
                    <i class="bi bi-truck me-2"></i>{{ __('messages.phone_results') }}
                </h4>

                @if ($deliveries->count())
                    @foreach ($deliveries as $delivery)
                        @php
                            $steps = ['pending', 'picked_up', 'in_transit', 'delivered'];
                            $currentIndex = array_search($delivery->status, $steps);
                            $isCancelled = $delivery->status === 'cancelled';
                        @endphp

                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="mb-1">
                                            <code>{{ $delivery->tracking_number }}</code>
                                        </h5>
                                        <small class="text-muted">{{ $delivery->created_at->format('M d, Y h:i A') }}</small>
                                    </div>
                                    @if ($isCancelled)
                                        <span class="badge bg-danger fs-6">{{ __('messages.cancelled') }}</span>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <div class="d-flex justify-content-between position-relative">
                                        @foreach ($steps as $i => $step)
                                            @php
                                                if ($isCancelled) {
                                                    $class = $i === 0 ? 'completed' : 'cancelled';
                                                } elseif ($i < $currentIndex) {
                                                    $class = 'completed';
                                                } elseif ($i === $currentIndex) {
                                                    $class = 'active';
                                                } else {
                                                    $class = '';
                                                }
                                            @endphp
                                            <div class="status-step {{ $class }}">
                                                <div class="step-icon">
                                                    @if ($class === 'completed')
                                                        <i class="bi bi-check-lg"></i>
                                                    @elseif ($class === 'cancelled')
                                                        <i class="bi bi-x-lg"></i>
                                                    @elseif ($class === 'active' && $step === 'delivered')
                                                        <i class="bi bi-check-lg"></i>
                                                    @elseif ($class === 'active' && $step === 'in_transit')
                                                        <i class="bi bi-truck"></i>
                                                    @elseif ($class === 'active' && $step === 'picked_up')
                                                        <i class="bi bi-box"></i>
                                                    @elseif ($class === 'active' && $step === 'pending')
                                                        <i class="bi bi-clock"></i>
                                                    @else
                                                        <i class="bi bi-circle"></i>
                                                    @endif
                                                </div>
                                                <div class="step-label small">{{ __("messages.{$step}") }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="text-primary mb-2"><i
                                                    class="bi bi-person-up me-1"></i>{{ __('messages.sender') }}</h6>
                                            <p class="mb-1"><strong>{{ $delivery->sender_name }}</strong></p>
                                            <p class="mb-1">{{ $delivery->sender_phone }}</p>
                                            <p class="mb-0 small text-muted">{{ $delivery->sender_address }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="text-success mb-2"><i
                                                    class="bi bi-person-down me-1"></i>{{ __('messages.receiver') }}</h6>
                                            <p class="mb-1"><strong>{{ $delivery->receiver_name }}</strong></p>
                                            <p class="mb-1">{{ $delivery->receiver_phone }}</p>
                                            <p class="mb-0 small text-muted">{{ $delivery->receiver_address }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mt-2">
                                    <div class="col-4 col-md-2">
                                        <small class="text-muted d-block">{{ __('messages.package_type') }}</small>
                                        <span>{{ __("messages.{$delivery->package_type}") }}</span>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <small class="text-muted d-block">{{ __('messages.weight') }}</small>
                                        <span>{{ $delivery->weight ? $delivery->weight . ' kg' : 'N/A' }}</span>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <small class="text-muted d-block">{{ __('messages.fee') }}</small>
                                        <span>${{ number_format($delivery->delivery_fee, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-search display-1 text-muted"></i>
                        <p class="mt-3 text-muted">{{ __('messages.no_deliveries_found') }}</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection