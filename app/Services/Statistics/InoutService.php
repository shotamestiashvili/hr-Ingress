<?php

namespace App\Services\Statistics;

use App\Models\Attendance;



class InoutService
{
    public $att_in;
    public $att_break;
    public $att_resume;
    public $att_out;


    public function __construct($userid, $date)
    {
        // $this->attInFactoryobject = new AttInFactory();
        // $this->att_in = (new AttInFactory())->startFactory($userid, $date);
        $this->att_in =   Attendance::where('userid', $userid)
        ->where('date', $date)
        ->value('att_in');


        // $this->attBreakFactoryobject = new AttBreakFactory();
        // $this->att_break = (new AttBreakFactory())->startFactory($userid, $date);

        $this->att_out =  Attendance::where('userid', $userid)
            ->where('date',   $date)
            ->value('att_out');



        $this->att_break =  Attendance::where('userid', $userid)
        ->where('date',   $date)
        ->value('att_break');



        // $this->attResumeFactoryobject = new AttResumeFactory();
        // $this->att_resume = (new AttResumeFactory())->startFactory($userid, $date);

        $this->att_resume =  Attendance::where('userid', $userid)
        ->where('date',   $date)
        ->value('att_resume');


        // $this->attOutFactoryobject = new AttOutFactory();
        // $this->att_out = (new AttOutFactory())->startFactory($userid, $date);

    }

}
