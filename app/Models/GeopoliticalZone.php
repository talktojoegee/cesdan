<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeopoliticalZone extends Model
{
    use HasFactory;

    protected $fillable = ['geo_name'];

    public function getAllGeopoliticalZones(){
        return GeopoliticalZone::orderBy('geo_name', 'ASC')->get();
    }
}
