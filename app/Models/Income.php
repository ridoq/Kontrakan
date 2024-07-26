<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_proof',
        'user_id',
        'amount',
        'income_date',
        'description',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
