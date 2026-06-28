<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Delivery extends Model
{
    protected $fillable = [
        'user_id',
        'tracking_number',
        'sender_name',
        'sender_phone',
        'sender_address',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'package_type',
        'description',
        'weight',
        'notes',
        'delivery_fee',
        'estimated_delivery',
        'status',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Delivery $delivery) {
            $delivery->tracking_number = 'DLV-' . strtoupper(Str::random(8));

            $weight = $delivery->weight ?? 1;
            if ($weight <= 20) {
                $delivery->delivery_fee = 1.00;
            } else {
                $delivery->delivery_fee = 2.50;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
