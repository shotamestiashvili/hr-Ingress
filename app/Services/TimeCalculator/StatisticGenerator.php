<?php

namespace App\Services\TimeCalculator;

use App\Jobs\StatisticCreator;
use App\Jobs\StatisticUpdater;
use App\Models\Inout;
use App\Models\Personnel;
use App\Models\Statistic;
use App\Services\DateTime\DateTimeFormater;
use App\Services\Statistics\ActualDate;
use Carbon\Carbon;

class StatisticGenerator extends ActualDate
{
    public function generateMonthly() :void
    {
        $month = $this->actualMonth;
        $year = $this->actualYear;
        Personnel::get('userid')->map(function ($user) use ($month, $year) {
            return Inout::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('userid', 352)
                ->get('date')
                ->map(function ($date) use ($user) {

                    $time = (new TimeService($user->userid, $date->date));

                    if (Statistic::where('userid', $user->userid)
                        ->where('date', $date->date)
                        ->exists()) {
                        StatisticUpdater::dispatch($time->earlyIn, $time->delayIn, $time->lateOut, $time->earlyOut, $user->userid, $date->date)
                            ->delay(10);
                    } else
                        StatisticCreator::dispatch($time->earlyIn, $time->delayIn, $time->lateOut, $time->earlyOut, $user->userid, $date->date)
                            ->delay(10);

                });
        });
    }

    public function generateDaily(): void
    {
        $day = $this->actualDay;
        Personnel::get('userid')->map(function ($user) use ($day) {
            return Inout::whereDay('date', $day)
                ->where('userid', 352)
                ->get('date')
                ->map(function ($date) use ($user) {

                    $time = (new TimeService($user->userid, $date->date));

                    if (Statistic::where('userid', $user->userid)
                        ->where('date', $date->date)
                        ->exists()) {
                        StatisticUpdater::dispatch($time->earlyIn, $time->delayIn, $time->lateOut, $time->earlyOut, $user->userid, $date->date)
                            ->delay(10);
                    } else
                        StatisticCreator::dispatch($time->earlyIn, $time->delayIn, $time->lateOut, $time->earlyOut, $user->userid, $date->date)
                            ->delay(10);

                });
        });
    }
}

