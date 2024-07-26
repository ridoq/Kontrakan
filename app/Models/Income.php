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
<<<<<<< HEAD
        'has_paid_until',
=======
        'status',
>>>>>>> 6b7c9a3b3d212c2be641baf62f9a0e6a1fa262d6
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
