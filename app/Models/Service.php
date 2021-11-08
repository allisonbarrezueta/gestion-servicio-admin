<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $withCount = ['requests'];
    protected $appends = ['image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function getImageAttribute($value)
    {
        return asset("/storage/{$value}");
    }
}
