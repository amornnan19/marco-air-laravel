<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'content', 
        'image',
        'link_url',
        'button_text',
        'is_active',
        'start_date',
        'end_date',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent(Builder $query): Builder
    {
        $now = Carbon::now();
        return $query->where(function($q) use ($now) {
            $q->where('start_date', '<=', $now)
              ->orWhereNull('start_date');
        })->where(function($q) use ($now) {
            $q->where('end_date', '>=', $now)
              ->orWhereNull('end_date');
        });
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    public function getIsCurrentAttribute(): bool
    {
        $now = Carbon::now();
        $startValid = is_null($this->start_date) || $this->start_date <= $now;
        $endValid = is_null($this->end_date) || $this->end_date >= $now;
        
        return $startValid && $endValid;
    }

    // Image accessor to get full URL
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
