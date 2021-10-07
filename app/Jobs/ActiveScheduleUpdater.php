<?php

namespace App\Jobs;

use App\Models\ActiveSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ActiveScheduleUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userid;
    private $startdate;
    private $in24;
    private $previousIn24;
    private $intime;
    private $outtime;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userid, $startdate, $in24, $previousIn24, $intime, $outtime)
    {
        $this->userid = $userid;
        $this->startdate = $startdate;
        $this->in24 = $in24;
        $this->previousIn24 = $previousIn24;
        $this->intime = $intime;
        $this->outtime = $outtime;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ActiveSchedule::where('userid', $this->userid)
            ->where('startdate', $this->startdate)
            ->update([
                'intime' =>  $this->intime,
                'outtime' => $this->outtime,
            ]);

    }
}
