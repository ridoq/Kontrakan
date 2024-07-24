<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'expense_date',
        'description',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
