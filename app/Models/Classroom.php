<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'name',
        'polo_id',
        'course'
    ];

    public function teacher(){
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function students(){
        return $this->hasMany(ClassStudent::class);
    }

    public function polo(){
        return $this->belongsTo(Polo::class);
    }
    
}
