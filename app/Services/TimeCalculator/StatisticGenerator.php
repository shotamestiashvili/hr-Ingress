<?php

namespace App\Services\TimeCalculator;

use App\Models\Personnel;
use App\Models\Statistic;
use App\Services\DateTime\DateTimeFormater;
use Carbon\Carbon;

class StatisticGenerator
{
    public function Generate ()
    {
        //  $carbon = Carbon::now()->toString();
        //  $date = DateTimeFormater::date($carbon);

     $date = '2021-09-02';


       return Personnel::all()->map(function ($user) use ($date) {
            $time = (new TimeService($user->userid, $date));
            if(Statistic::where('userid', $user->userid)->where('date', $date)->exists()){

                Statistic::where('userid', $user->userid)->where('date', $date)->update([

                    'earlyIn' =>  $time->earlyIn,
                    'delayIn' =>  $time->delayIn,
                    'lateOut' =>  $time->lateOut,
                    'earlyOut'=>  $time->earlyOut,
                ]);
            }else{
                Statistic::create([
                       'userid'  =>  $user->userid,
                       'date'    =>  $date,
                       'earlyIn' =>  $time->earlyIn,
                       'delayIn' =>  $time->delayIn,
                       'lateOut' =>  $time->lateOut,
                       'earlyOut'=>  $time->earlyOut,
            ]);
            }
        });
    }
}
