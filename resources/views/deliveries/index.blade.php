@extends('layouts.app')

@section('title', __('messages.deliveries'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-truck me-2"></i>{{ __('messages.my_deliveries') }}</h2>
    @if (Auth::user()->role === 'admin')
        <a href="{{ route('deliveries.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-lg me-1"></i>{{ __('messages.new_delivery') }}
        </a>
    @endif
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($deliveries->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.tracking') }}</th>
                    <th>{{ __('messages.sender') }}</th>
                    <th>{{ __('messages.receiver') }}</th>
                    <th>{{ __('messages.package_type') }}</th>
                    <th>{{ __('messages.fee') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveries as $d)
                    <tr>
                        <td><code>{{ $d->tracking_number }}</code></td>
                        <td>{{ $d->sender_name }}</td>
                        <td>{{ $d->receiver_name }}</td>
                        <td>{{ __("messages.{$d->package_type}") }}</td>
                        <td>${{ number_format($d->delivery_fee, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $d->status === 'delivered' ? 'success' : ($d->status === 'cancelled' ? 'danger' : ($d->status === 'in_transit' ? 'info' : ($d->status === 'picked_up' ? 'warning' : 'secondary'))) }}">
                                {{ __("messages.{$d->status}") }}
                            </span>
                        </td>
                        <td>{{ $d->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('deliveries.show', $d) }}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $deliveries->links() }}
@else
    <div class="text-center py-5">
        <i class="bi bi-truck display-1 text-muted"></i>
        <p class="mt-3 text-muted">{{ __('messages.no_deliveries') }}</p>
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('deliveries.create') }}" class="btn btn-dark">{{ __('messages.create_first') }}</a>
        @endif
    </div>
@endif
@endsection
