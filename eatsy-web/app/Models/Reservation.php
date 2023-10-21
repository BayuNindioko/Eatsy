<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id', 'name', 'status'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
