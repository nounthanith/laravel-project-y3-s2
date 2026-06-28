@extends('layouts.app')

@section('title', 'New Delivery')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>New Delivery Order</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('deliveries.store') }}">
                    @csrf

                    <h6 class="text-secondary border-bottom pb-2 mb-3">
                        <i class="bi bi-person-up me-1"></i>Sender Information
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="sender_name" class="form-control @error('sender_name') is-invalid @enderror" value="{{ old('sender_name') }}" required>
                            @error('sender_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="sender_phone" class="form-control @error('sender_phone') is-invalid @enderror" value="{{ old('sender_phone') }}" required>
                            @error('sender_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Province (From) <span class="text-danger">*</span></label>
                        <select name="sender_address" class="form-select @error('sender_address') is-invalid @enderror" required>
                            <option value="">Select province...</option>
                            <option value="Phnom Penh" {{ old('sender_address') === 'Phnom Penh' ? 'selected' : '' }}>Phnom Penh</option>
                            <option value="Battambang" {{ old('sender_address') === 'Battambang' ? 'selected' : '' }}>Battambang</option>
                            <option value="Siem Reap" {{ old('sender_address') === 'Siem Reap' ? 'selected' : '' }}>Siem Reap</option>
                            <option value="Sihanoukville" {{ old('sender_address') === 'Sihanoukville' ? 'selected' : '' }}>Sihanoukville</option>
                            <option value="Kampong Cham" {{ old('sender_address') === 'Kampong Cham' ? 'selected' : '' }}>Kampong Cham</option>
                            <option value="Kampong Thom" {{ old('sender_address') === 'Kampong Thom' ? 'selected' : '' }}>Kampong Thom</option>
                            <option value="Takeo" {{ old('sender_address') === 'Takeo' ? 'selected' : '' }}>Takeo</option>
                            <option value="Pursat" {{ old('sender_address') === 'Pursat' ? 'selected' : '' }}>Pursat</option>
                            <option value="Kampot" {{ old('sender_address') === 'Kampot' ? 'selected' : '' }}>Kampot</option>
                            <option value="Kandal" {{ old('sender_address') === 'Kandal' ? 'selected' : '' }}>Kandal</option>
                            <option value="Prey Veng" {{ old('sender_address') === 'Prey Veng' ? 'selected' : '' }}>Prey Veng</option>
                            <option value="Svay Rieng" {{ old('sender_address') === 'Svay Rieng' ? 'selected' : '' }}>Svay Rieng</option>
                            <option value="Banteay Meanchey" {{ old('sender_address') === 'Banteay Meanchey' ? 'selected' : '' }}>Banteay Meanchey</option>
                            <option value="Koh Kong" {{ old('sender_address') === 'Koh Kong' ? 'selected' : '' }}>Koh Kong</option>
                            <option value="Kratie" {{ old('sender_address') === 'Kratie' ? 'selected' : '' }}>Kratie</option>
                            <option value="Stung Treng" {{ old('sender_address') === 'Stung Treng' ? 'selected' : '' }}>Stung Treng</option>
                            <option value="Ratanakiri" {{ old('sender_address') === 'Ratanakiri' ? 'selected' : '' }}>Ratanakiri</option>
                            <option value="Mondulkiri" {{ old('sender_address') === 'Mondulkiri' ? 'selected' : '' }}>Mondulkiri</option>
                            <option value="Preah Vihear" {{ old('sender_address') === 'Preah Vihear' ? 'selected' : '' }}>Preah Vihear</option>
                            <option value="Oddar Meanchey" {{ old('sender_address') === 'Oddar Meanchey' ? 'selected' : '' }}>Oddar Meanchey</option>
                            <option value="Kep" {{ old('sender_address') === 'Kep' ? 'selected' : '' }}>Kep</option>
                            <option value="Pailin" {{ old('sender_address') === 'Pailin' ? 'selected' : '' }}>Pailin</option>
                            <option value="Tboung Khmum" {{ old('sender_address') === 'Tboung Khmum' ? 'selected' : '' }}>Tboung Khmum</option>
                        </select>
                        @error('sender_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <h6 class="text-secondary border-bottom pb-2 mb-3">
                        <i class="bi bi-person-down me-1"></i>Receiver Information
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="receiver_name" class="form-control @error('receiver_name') is-invalid @enderror" value="{{ old('receiver_name') }}" required>
                            @error('receiver_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="receiver_phone" class="form-control @error('receiver_phone') is-invalid @enderror" value="{{ old('receiver_phone') }}" required>
                            @error('receiver_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Province (To) <span class="text-danger">*</span></label>
                        <select name="receiver_address" class="form-select @error('receiver_address') is-invalid @enderror" required>
                            <option value="">Select province...</option>
                            <option value="Phnom Penh" {{ old('receiver_address') === 'Phnom Penh' ? 'selected' : '' }}>Phnom Penh</option>
                            <option value="Battambang" {{ old('receiver_address') === 'Battambang' ? 'selected' : '' }}>Battambang</option>
                            <option value="Siem Reap" {{ old('receiver_address') === 'Siem Reap' ? 'selected' : '' }}>Siem Reap</option>
                            <option value="Sihanoukville" {{ old('receiver_address') === 'Sihanoukville' ? 'selected' : '' }}>Sihanoukville</option>
                            <option value="Kampong Cham" {{ old('receiver_address') === 'Kampong Cham' ? 'selected' : '' }}>Kampong Cham</option>
                            <option value="Kampong Thom" {{ old('receiver_address') === 'Kampong Thom' ? 'selected' : '' }}>Kampong Thom</option>
                            <option value="Takeo" {{ old('receiver_address') === 'Takeo' ? 'selected' : '' }}>Takeo</option>
                            <option value="Pursat" {{ old('receiver_address') === 'Pursat' ? 'selected' : '' }}>Pursat</option>
                            <option value="Kampot" {{ old('receiver_address') === 'Kampot' ? 'selected' : '' }}>Kampot</option>
                            <option value="Kandal" {{ old('receiver_address') === 'Kandal' ? 'selected' : '' }}>Kandal</option>
                            <option value="Prey Veng" {{ old('receiver_address') === 'Prey Veng' ? 'selected' : '' }}>Prey Veng</option>
                            <option value="Svay Rieng" {{ old('receiver_address') === 'Svay Rieng' ? 'selected' : '' }}>Svay Rieng</option>
                            <option value="Banteay Meanchey" {{ old('receiver_address') === 'Banteay Meanchey' ? 'selected' : '' }}>Banteay Meanchey</option>
                            <option value="Koh Kong" {{ old('receiver_address') === 'Koh Kong' ? 'selected' : '' }}>Koh Kong</option>
                            <option value="Kratie" {{ old('receiver_address') === 'Kratie' ? 'selected' : '' }}>Kratie</option>
                            <option value="Stung Treng" {{ old('receiver_address') === 'Stung Treng' ? 'selected' : '' }}>Stung Treng</option>
                            <option value="Ratanakiri" {{ old('receiver_address') === 'Ratanakiri' ? 'selected' : '' }}>Ratanakiri</option>
                            <option value="Mondulkiri" {{ old('receiver_address') === 'Mondulkiri' ? 'selected' : '' }}>Mondulkiri</option>
                            <option value="Preah Vihear" {{ old('receiver_address') === 'Preah Vihear' ? 'selected' : '' }}>Preah Vihear</option>
                            <option value="Oddar Meanchey" {{ old('receiver_address') === 'Oddar Meanchey' ? 'selected' : '' }}>Oddar Meanchey</option>
                            <option value="Kep" {{ old('receiver_address') === 'Kep' ? 'selected' : '' }}>Kep</option>
                            <option value="Pailin" {{ old('receiver_address') === 'Pailin' ? 'selected' : '' }}>Pailin</option>
                            <option value="Tboung Khmum" {{ old('receiver_address') === 'Tboung Khmum' ? 'selected' : '' }}>Tboung Khmum</option>
                        </select>
                        @error('receiver_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <h6 class="text-secondary border-bottom pb-2 mb-3">
                        <i class="bi bi-box-seam me-1"></i>Package Details
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <select name="package_type" class="form-select @error('package_type') is-invalid @enderror" required>
                                <option value="">Select type...</option>
                                <option value="document" {{ old('package_type') === 'document' ? 'selected' : '' }}>Document</option>
                                <option value="parcel" {{ old('package_type') === 'parcel' ? 'selected' : '' }}>Parcel</option>
                                <option value="electronics" {{ old('package_type') === 'electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="fragile" {{ old('package_type') === 'fragile' ? 'selected' : '' }}>Fragile</option>
                                <option value="food" {{ old('package_type') === 'food' ? 'selected' : '' }}>Food</option>
                                <option value="other" {{ old('package_type') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('package_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="form-label">Weight (kg)</label>
                            <input type="number" step="0.01" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}">
                            @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Est. Delivery Date</label>
                            <input type="date" name="estimated_delivery" class="form-control @error('estimated_delivery') is-invalid @enderror" value="{{ old('estimated_delivery') }}">
                            @error('estimated_delivery')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="2" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" rows="2" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                        @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-1"></i>
                        Delivery fee is auto-calculated based on weight:
                        <strong>1–20 kg = $1.00</strong> |
                        <strong>Over 20 kg = $2.50</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('deliveries.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-dark"><i class="bi bi-check-lg me-1"></i>Create Delivery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
