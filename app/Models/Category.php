<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all products for the category
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get formatted created_at date
     */
    public function getCreatedAtAttribute($value): string
    {
        return date('d.m.Y H:i', strtotime($value));
    }

    /**
     * Get formatted updated_at date
     */
    public function getUpdatedAtAttribute($value): string
    {
        return date('d.m.Y H:i', strtotime($value));
    }
}
