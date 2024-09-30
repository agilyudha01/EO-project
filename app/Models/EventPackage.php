<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

     public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_event_package');
    }
}
