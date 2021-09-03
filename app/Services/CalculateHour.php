<?php

namespace App\Services;

use App\Models\Attendance;

class CalculateHour
{

    public $workIn;
    public $workOut;
    public $workBreak;
    public $workResume;

    public $workTime;
    public $breakTime;

    public $overTime;
    public $delayAtWork;
    public $earlyFromWork;




    public function __construct($userid, $dateTime)
    {
        $inTime      = explode(':', $this->valueValidation($userid, $dateTime, 'att_in'));
        $outTime     = explode(':', $this->valueValidation($userid, $dateTime, 'att_out'));
        $att_break   = explode(':', $this->valueValidation($userid, $dateTime, 'att_break'));
        $att_resume  = explode(':', $this->valueValidation($userid, $dateTime, 'att_resume'));

        $this->workIn     = $this->convertAtt($inTime);
        $this->workOut    = $this->convertAtt($outTime);
        $this->workBreak  = $this->convertAtt($att_break);
        $this->workResume = $this->convertAtt($att_resume);

        // Out Hours/Minutes minus In Hours/Minutes to calculate how many hours have been worked user.
        $this->workTime  =  ((int)$outTime[0] - (int)$inTime[0]) . ':' . ((int)$outTime[1] - (int)$inTime[1]);
        $this->breakTime =  ((int)$att_resume[0] - (int)$att_break[0]) . ':' . ((int)$att_resume[1] - (int)$att_break[1]);
    }

    protected function valueValidation($userid, $dateTime, $value){

        if (Attendance::where('userid', $userid)
        ->where('date', $dateTime)
        ->value($value) !== null)

        {
            return Attendance::where('userid', $userid)
            ->where('date', $dateTime)
            ->value($value);
        } else {
            return "00:00";
        }
    }

    protected function convertAtt($att){
        return ((int)$att[0].':'.(int)$att[1]);
    }



}
