<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaidLeaveResource;
use App\Models\PaidLeave;
use App\Models\Personnel;
use Illuminate\Http\Request;

class PaidLeaveController extends Controller
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

        $paidLeave = Personnel::with(['paidleave' => function ($q) use ($year) {
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

        return PaidLeaveResource::collection($paidLeave);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PaidLeave $paidLeave
     * @return \Illuminate\Http\Response
     */
    public function show(PaidLeave $paidLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PaidLeave $paidLeave
     * @return \Illuminate\Http\Response
     */
    public function edit(PaidLeave $paidLeave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaidLeave $paidLeave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaidLeave $paidLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PaidLeave $paidLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaidLeave $paidLeave)
    {
        //
    }
}
