<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;
    protected $fillable = ['discipline_name'];

    public function getAllDisciplines(){
        return Discipline::orderBy('discipline_name', 'ASC')->get();
    }
}
