<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'street',
        'building',
        'floor',
        'user_id',
    ];

    protected $table="address";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
}
