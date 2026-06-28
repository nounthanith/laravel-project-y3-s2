@extends('layouts.app')

@section('title', 'Deliveries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-truck me-2"></i>My Deliveries</h2>
    <a href="{{ route('deliveries.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg me-1"></i>New Delivery
    </a>
</div>

<!-- @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif -->

@if ($deliveries->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tracking</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Type</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveries as $d)
                    <tr>
                        <td><code>{{ $d->tracking_number }}</code></td>
                        <td>{{ $d->sender_name }}</td>
                        <td>{{ $d->receiver_name }}</td>
                        <td>{{ ucfirst($d->package_type) }}</td>
                        <td>${{ number_format($d->delivery_fee, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $d->status === 'delivered' ? 'success' : ($d->status === 'cancelled' ? 'danger' : ($d->status === 'in_transit' ? 'info' : ($d->status === 'picked_up' ? 'warning' : 'secondary'))) }}">
                                {{ str_replace('_', ' ', ucfirst($d->status)) }}
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
        <p class="mt-3 text-muted">No deliveries yet.</p>
        <a href="{{ route('deliveries.create') }}" class="btn btn-dark">Create Your First Delivery</a>
    </div>
@endif
@endsection
