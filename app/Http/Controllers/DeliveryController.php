<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        return view('deliveries.index', compact('deliveries'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('deliveries.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:20',
            'sender_address' => 'required|string',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'receiver_address' => 'required|string',
            'package_type' => 'required|string|in:document,parcel,electronics,fragile,food,other',
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0|max:99999',
            'notes' => 'nullable|string',
            'estimated_delivery' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();

        Delivery::create($validated);

        return redirect()->route('deliveries.index')
            ->with('success', 'Delivery order created successfully.');
    }

    public function show(Delivery $delivery)
    {
        if ($delivery->user_id !== auth()->id()) {
            abort(403);
        }
        return view('deliveries.show', compact('delivery'));
    }

    public function updateStatus(Request $request, Delivery $delivery)
    {
        if ($delivery->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|string|in:pending,picked_up,in_transit,delivered,cancelled',
        ]);

        $delivery->update(['status' => $validated['status']]);

        return back()->with('success', __('messages.status') . ' ' . __("messages.{$validated['status']}"));
    }

    public function trackByPhone(Request $request)
    {
        $deliveries = collect();
        $phone = $request->input('phone');

        if ($phone) {
            $deliveries = Delivery::where('sender_phone', $phone)
                ->orWhere('receiver_phone', $phone)
                ->latest()
                ->get();
        }

        return view('welcome', compact('deliveries', 'phone'));
    }

    public function track(Request $request)
    {
        $request->validate(['tracking_number' => 'required|string']);

        $delivery = Delivery::where('tracking_number', $request->tracking_number)->first();

        if (!$delivery) {
            return back()->with('error', 'Tracking number not found.');
        }

        return view('deliveries.show', compact('delivery'));
    }
}
