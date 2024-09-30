<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function eventPackages()
    {
        return $this->belongsToMany(EventPackage::class, 'category_event_package');
    }
}
