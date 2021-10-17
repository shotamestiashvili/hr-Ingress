<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SickLeaveResource;
use App\Models\Personnel;
use App\Models\SickLeave;
use Illuminate\Http\Request;

class SickLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $row  = request('row');
        $year = request('year');

        $sickLeave = Personnel::with(['sickleave' => function ($q) use ($year) {
            $q->whereYear('leave_date', $year)->get();
        }])->when(request('search') != '', function ($query) use ($row) {
            return $query->where('first_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('last_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('department', 'LIKE', '%' . request('search') . '%')
                ->orWhere('userid', 'LIKE', '%' . request('search') . '%')
                ->paginate($row);
        })->when(request('search') == '', function ($query) use ($row) {
            return $query->paginate($row);
        });


        return SickLeaveResource::collection($sickLeave);
    }

}
