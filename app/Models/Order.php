<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'product_id',
        'quantity',
        'status',
        'comment'
    ];

    protected $attributes = [
        'status' => 'new',
        'quantity' => 1,
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Get the product that owns the order
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calculate total price for the order
     */
    public function getTotalPriceAttribute(): float
    {
        return $this->product->price * $this->quantity;
    }

    /**
     * Format total price with currency
     */
    public function getFormattedTotalPriceAttribute(): string
    {
        return number_format($this->total_price, 2) . ' ₽';
    }

    /**
     * Scope for new orders
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope for completed orders
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Mark order as completed
     */
    public function markAsCompleted(): bool
    {
        return $this->update(['status' => 'completed']);
    }
}
