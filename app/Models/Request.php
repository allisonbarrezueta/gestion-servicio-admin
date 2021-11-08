<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Request extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['image'];

    protected $withCount = ['bids'];

    protected $dates = ['date'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function scopeWithActiveOffer($query, $supplierId)
    {
        return $query->whereHas('bids', function ($query) use ($supplierId) {
            return $query->where('user_id', $supplierId);
        })->whereHas('bids', function ($query) {
            return $query->where('status', '!=', 'accepted');
        });
    }

    public function scopeWithInactiveOffer($query, $supplierId)
    {
        return $query->whereHas('bids', function ($query) {
            return $query->where('status', 'accepted');
        })->whereHas('bids', function ($query) use ($supplierId) {
            return $query->where('user_id', $supplierId);
        });
    }
}
