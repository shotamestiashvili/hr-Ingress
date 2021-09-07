<?php

namespace App\Services\DateTime;

use App\Models\Worktype;
use App\Services\TimeCalculator\TimeExploder;
use Carbon\Carbon;


class WorkTypeFormater extends TimeExploder
{

    public function worktypeStart()
    {
        $worktype = new Worktype();
        return $worktype->all()->map(function ($worktype) {
            $worktype->where('start', $worktype['start'])->update([
                'start' => DateTimeFormater::time('2021-9-1' . ' ' . $worktype['start'])
            ]);
        });
    }

    public function worktypeEnd()
    {
        $worktype = new Worktype();
        return $worktype->all()->map(function ($worktype) {
            $worktype->where('end', $worktype['end'])->update([
                'end' => DateTimeFormater::time('2021-9-1' . ' ' . $worktype['end'])
            ]);
        });
    }

    public function in24Hours($hours)
    {
        if (      $this->startMin == 0 && $this->startHour + $hours < 24) {
            return 1;
        } elseif ($this->startMin == 0 && $this->startHour + $hours == 24) {
            return 1;
        } elseif ($this->startMin == 0 && $this->startHour + $hours > 24) {
            return 0;

        } elseif ($this->startMin == 30 && $this->startHour + $hours < 24) {
            return 1;
        } elseif ($this->startMin == 30 && $this->startHour + $hours == 24) {
            return 0;
        }elseif ($this->startMin  == 30 && $this->startHour + $hours > 24) {
            return 0;
        }
    }

    public function worktypeHoursGen()
    {

        if ($this->startHour > $this->endHour && $this->startMin > $this->endMin) {

            if ($this->startMin - $this->endMin == 0) {
                return ($this->endHour + 24 - $this->startHour);
            } else {
                return ($this->endHour + 24 - $this->startHour) + 1;
            }
        } elseif ($this->startHour > $this->endHour && $this->startMin < $this->endMin) {

            if ($this->endMin - $this->startMin == 0) {
                return ($this->endHour + 24 - $this->startHour);
            } else {
                return ($this->endHour + 24 - $this->startHour) + 1;
            }
        } elseif ($this->startHour > $this->endHour && $this->startMin == $this->endMin) {

            return ($this->endHour + 24 - $this->startHour);
        } elseif ($this->startHour < $this->endHour && $this->startMin > $this->endMin) {

            if ($this->startMin - $this->endMin == 0) {
                return ($this->endHour - $this->startHour);
            } else {
                return ($this->endHour - $this->startHour) + 1;
            }
        } elseif ($this->startHour < $this->endHour && $this->startMin < $this->endMin) {

            if ($this->endMin - $this->startMin == 0) {
                return ($this->endHour - $this->startHour);
            } else {
                return ($this->endHour - $this->startHour) + 1;
            }
        } elseif ($this->startHour < $this->endHour && $this->startMin == $this->endMin) {

            return ($this->endHour - $this->startHour);
        } elseif ($this->startHour == $this->endHour && $this->startMin > $this->endMin) {

            if ($this->startMin - $this->endMin == 0) {
                return (0);
            } else {
                return 1;
            }
        } elseif ($this->startHour == $this->endHour && $this->startMin < $this->endMin) {

            if ($this->endMin - $this->startMin == 0) {
                return (0);
            } else {
                return 1;
            }
        } elseif ($this->startHour == $this->endHour && $this->startMin == $this->endMin) {

            return 24;
        }
    }
}
