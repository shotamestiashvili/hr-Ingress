<?php

namespace App\Jobs;

use App\Models\Statistic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $earlyIn;
    private $delayIn;
    private $lateOut;
    private $earlyOut;
    private $userid;
    private $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($earlyIn, $delayIn, $lateOut, $earlyOut, $userid, $date)
    {
        $this->earlyIn  = $earlyIn;
        $this->delayIn  = $delayIn;
        $this->lateOut  = $lateOut;
        $this->earlyOut = $earlyOut;
        $this->userid   = $userid;
        $this->date     = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Statistic::where('userid', $this->userid)
                 ->where('date', $this->date)
                 ->update([
            'earlyIn'  => $this->earlyIn,
            'delayIn'  => $this->delayIn,
            'lateOut'  => $this->lateOut,
            'earlyOut' => $this->earlyOut,
        ]);
    }
}
