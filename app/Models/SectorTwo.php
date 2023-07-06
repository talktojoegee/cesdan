<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorTwo extends Model
{
    use HasFactory;
    protected $fillable = ['sector_name'];

    public function getAllSectorTwo()
    {
        return SectorTwo::orderBy('sector_name', 'ASC')->get();
    }
}
