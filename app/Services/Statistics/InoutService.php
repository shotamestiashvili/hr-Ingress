<?php

namespace App\Services\Statistics;

use App\Services\Statistics\AttInFactory;
use App\Services\Statistics\AttBreakFactory;
use App\Services\Statistics\AttResumeFactory;
use App\Services\Statistics\AttOutFactory;



class InoutService
{
    public $att_in;
    public $att_break;
    public $att_resume;
    public $att_out;


    public function __construct($userid, $date)
    {
        // $this->attInFactoryobject = new AttInFactory();
        $this->att_in = (new AttInFactory())->startFactory($userid, $date);

        // $this->attBreakFactoryobject = new AttBreakFactory();
        $this->att_break = (new AttBreakFactory())->startFactory($userid, $date);

        // $this->attResumeFactoryobject = new AttResumeFactory();
        $this->att_resume = (new AttResumeFactory())->startFactory($userid, $date);

        // $this->attOutFactoryobject = new AttOutFactory();
        $this->att_out = (new AttOutFactory())->startFactory($userid, $date);

    }

}
