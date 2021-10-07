<?php

namespace App\Services\TimeCalculator;

use App\Jobs\StatisticCreator;
use App\Jobs\StatisticUpdater;
use App\Models\ActiveSchedule;
use App\Models\Inout;
use App\Models\Personnel;
use App\Models\Statistic;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;
use App\Services\Statistics\ActualDate;
use Carbon\Carbon;
use App\Services\TimeCalculator\TimeService;

class StatisticGenerator extends ActualDate
{
    public function generateMonthly(): void
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

    public function generateDaily()
    {
//        $today = Carbon::now()->toDateString();

        $today = Carbon::parse('2021-10-02')->toDateString();
//        $today = DateTimeFormater::date($today);
//        $user = 205;

        return Personnel::get('userid')->map(function ($user) use ($today) {
            return ActiveSchedule::with('worktypes')
                ->where('enddate', $today)
                ->where('userid', $user->userid)
                ->get()
                ->map(function ($active_schedule) use ($user, $today) {

                    $in24 = Worktype::where('code', $active_schedule->worktype)
                        ->value('in24hours');

                    $time = (new TimeService($active_schedule, $in24));

                    if (Statistic::where('userid', $user)
                        ->where('date', date($today))
                        ->exists()) {

                        StatisticUpdater::dispatch(
                            $time->earlyIn,
                            $time->delayIn,
                            $time->lateOut,
                            $time->earlyOut,
                            $user->userid,
                            $today)
                            ->delay(10);
                    } else{

                        StatisticCreator::dispatch(
                            $time->earlyIn,
                            $time->delayIn,
                            $time->lateOut,
                            $time->earlyOut,
                            $user->userid,
                            $today)
                            ->delay(10);
                    }

                });
        });
    }
}

