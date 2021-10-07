<?php

namespace App\Services\TimeCalculator;

use App\Models\Inout;

class HumanAttendance
{

    public $first;
    public $second;
    public $third;
    public $fourth;


    public function __construct($userid, $date)
    {
        $this->attendance($userid, $date);

    }


    private function attendance($userid, $date)
    {
        $inout = Inout::where('userid', $userid)
            ->where('date', $date)
            ->select(['att_in', 'att_break', 'att_resume', 'att_out'])
            ->get()
            ->toArray();

        $new_array = [];

        foreach ($inout as $key => $value) {
            foreach ($value as $item) {
                if ($item !== null) {
                    array_push($new_array, $item);
                }
            }
        }

        $leftEl = 4 - (count($new_array));

        for ($i = 0; $i < $leftEl; $i++) {
            array_push($new_array, '0');
        }

//        dd($new_array);
        $this->first  = $new_array[0];
        $this->second = $new_array[1];
        $this->third  = $new_array[2];
        $this->fourth = $new_array[3];

    }
}
