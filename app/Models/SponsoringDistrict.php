<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsoringDistrict extends Model
{
    use HasFactory;
    protected $fillable = ['district_name'];


    public function getAllSponsoringDistricts(){
        return SponsoringDistrict::orderBy('district_name', 'ASC')->get();
    }
}
