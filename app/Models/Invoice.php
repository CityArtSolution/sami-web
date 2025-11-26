<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cart_ids',
        'gift_ids',
        'discount_amount',
        'loyalty_points_discount',
        'final_total',
    ];

    protected $casts = [
        'cart_ids' => 'array',
        'gift_ids' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

