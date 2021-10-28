<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'value',
        'date',
        'reference',
        'file',
        'paid'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
