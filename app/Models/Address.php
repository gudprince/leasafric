<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    
    protected $fillable = [
        "street",
        "suite",
        "city",
        "zipcode",
        "user_id",
        "suite"
    ];

    public function geo(){
        return $this->hasOne(Geo::class);
    }
}
