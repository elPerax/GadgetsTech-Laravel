<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'payment_type',
        'total',
    ];

  
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
