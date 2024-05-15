<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public function User(){
        return $this->belongsTo('App\Models\User');
    }
    public function Sanitarian(){
        return $this->belongsTo('App\Models\Sanitario');
    }
}
