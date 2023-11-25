<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'deskripsi', 'foto', 'price', 'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->categories()->detach();
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_items');
    }
}
