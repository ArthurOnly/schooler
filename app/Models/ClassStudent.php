<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'classroom_id'
    ];

    public function absence(){
        return $this->hasOne(Presence::class);
    }

    public function grade(){
        return $this->hasOne(Grade::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'student_id');
    }
}
