<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use App\Models\Personnel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(): object
    {
        if(request('row') == ''){
            $row = 31;
        }else{
            $row = request('row');
        }

        $year   = request('year');
        $month  = request('month');

        $personnel = Personnel::with(['schedule' => function ($q) use ($year, $month, $row) {
            $q->whereYear('date', $year)->whereMonth('date', $month)->get();
        }])->when(request('searchDepartments') != '', function ($query) use ($row) {
            return $query
                ->where('department', request('searchDepartments'))
                ->paginate($row);
        })->when(request('searchDepartments') == '', function ($query) use ($row) {
            return $query->paginate($row);
        });


        return PersonnelResource::collection($personnel);
    }

}
