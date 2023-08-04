<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $plans = [
            [
                'name'=>'Student Members',
                'usd_amount'=>15,
                'naira_amount'=>10000
            ],
            [
                'name'=>'Graduate Members',
                'usd_amount'=>20,
                'naira_amount'=>15000
            ],
            [
                'name'=>'Associate Members',
                'usd_amount'=>25,
                'naira_amount'=>20000
            ],
            [
                'name'=>'Full Members',
                'usd_amount'=>30,
                'naira_amount'=>25000
            ],
            [
                'name'=>'Fellows',
                'usd_amount'=>35,
                'naira_amount'=>30000
            ],
            [
                'name'=>'Honorary Fellows',
                'usd_amount'=>0,
                'naira_amount'=>0
            ],
        ];

        foreach($plans as $plan){
            SubscriptionPlan::create($plan);
        }
    }
}
