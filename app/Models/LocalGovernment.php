<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGovernment extends Model
{
    use HasFactory;

    public function getAllLocalGovernments(){
        return LocalGovernment::orderBy('local_name', 'ASC')->get();
    }


    public function getLocalGovernmentsByStateId($id){
        return LocalGovernment::where('state_id', $id)->orderBy('local_name', 'ASC')->get();
    }
}
