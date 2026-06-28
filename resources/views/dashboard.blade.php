@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2 me-2"></i>Dashboard</h2>
    <a href="{{ route('deliveries.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg me-1"></i>New Delivery
    </a>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card text-bg-primary shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-truck me-1"></i>Total Deliveries</h5>
                <p class="display-6 mb-0">{{ $stats['total'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-bg-warning shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-hourglass-split me-1"></i>Pending</h5>
                <p class="display-6 mb-0">{{ $stats['pending'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-bg-success shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-check-circle me-1"></i>Delivered</h5>
                <p class="display-6 mb-0">{{ $stats['delivered'] }}</p>
            </div>
        </div>
    </div>
</div>

@php
    $recent = \App\Models\Delivery::where('user_id', auth()->id())->latest()->take(5)->get();
@endphp

@if ($recent->count())
<div class="card shadow-sm mt-2">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Deliveries</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tracking</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recent as $d)
                    <tr>
                        <td><code>{{ $d->tracking_number }}</code></td>
                        <td>{{ $d->sender_name }}</td>
                        <td>{{ $d->receiver_name }}</td>
                        <td>
                            <span class="badge bg-{{ $d->status === 'delivered' ? 'success' : ($d->status === 'cancelled' ? 'danger' : ($d->status === 'in_transit' ? 'info' : ($d->status === 'picked_up' ? 'warning' : 'secondary'))) }}">
                                {{ str_replace('_', ' ', ucfirst($d->status)) }}
                            </span>
                        </td>
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
</div>
@endif
@endsection
