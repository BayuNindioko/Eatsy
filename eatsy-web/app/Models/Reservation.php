<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id', 'name', 'pin', 'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($reservation) {
            $reservation->table()->detach();
        });
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function order_items()
    {
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }
}
