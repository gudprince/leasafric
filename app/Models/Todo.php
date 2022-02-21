<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'completed'
    ];

    public function getCompletedAttribute($value)
    {   
        if($value == 1) {
            return true;
        }
        else{
            return false;
        }
    }
}
