<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'usd_amount', 'naira_amount'
    ];


    public static function getSubscriptionPlan(){
        return SubscriptionPlan::all();
    }
}
