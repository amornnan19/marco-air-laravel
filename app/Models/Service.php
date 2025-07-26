<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'hero_image',
        'icon_color',
        'packages',
        'details',
        'contact_phone',
        'price_display',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'packages' => 'array',
        'details' => 'array',
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }

    // Accessors
    public function getHeroImageUrlAttribute()
    {
        if ($this->hero_image) {
            return Storage::url($this->hero_image);
        }

        return null;
    }

    public function getFormattedPriceDisplayAttribute()
    {
        if ($this->price_display) {
            return number_format($this->price_display).' บาท';
        }

        return null;
    }

    // Helper methods
    public function calculateSortOrder()
    {
        $maxOrder = static::max('sort_order') ?? 0;

        return $maxOrder + 10;
    }
}
