<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function getAllStates(){
        return State::orderBy('state_name', 'ASC')->get();
    }
}
