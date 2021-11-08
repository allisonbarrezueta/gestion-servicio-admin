<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $withCount = ['services'];
    // protected $appends = ['image'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeSupplier($query, $supplierId)
    {
        return $query->whereHas('users', function ($query) use ($supplierId) {
            return $query->where('id', $supplierId);
        });
    }

    public function getImageAttribute($value)
    {
        return asset("/storage/{$value}");
    }
}
