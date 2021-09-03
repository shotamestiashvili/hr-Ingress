<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inout;

class InoutController extends Controller
{
    public function inout()
    {
        $useridArray = ['352', '339'];

        return Inout::whereMonth('date', '7')
            ->get()
            ->map(function ($inout)  use ($useridArray) {

                    return $inout->where('userid', $useridArray)->get();
                });




        // return InoutResource::collection($inoutData);
    }
}
