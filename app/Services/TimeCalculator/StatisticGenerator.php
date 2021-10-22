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
use App\Services\TimeCalculator\TimeService;
use Carbon\Carbon;


class StatisticGenerator extends ActualDate
{
    public function generateCustomDate($date)
    {
        $today = Carbon::createFromDate($date)->toDateString();

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
                    } else {

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

    public function generateDaily()
    {
        $today = Carbon::now()->toDateString();

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
                    } else {

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

