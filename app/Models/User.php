<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['average_rating', 'ratings', 'total_opinions'];

    protected $with = ['categories'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class, 'supplier_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->opinions()->avg('rating');
    }

    public function getRatingsAttribute()
    {
        $total = $this->total_opinions;
        $ratings = $this->opinions()->select('rating', \DB::raw('count(*) as total'))
            ->groupBy('rating')->get();

        $ratings = $ratings->each(function ($rating) use ($total) {
            $rating->percentage = $rating->total / $total * 100;
            $rating->rating = (int)$rating->rating;
            return $rating;
        });

        return $ratings;
    }

    public function getTotalOpinionsAttribute()
    {
        return $this->opinions()->where('status', true)->count();
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->lastname}";
    }
}
