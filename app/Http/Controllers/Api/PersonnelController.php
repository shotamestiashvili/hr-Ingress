<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use App\Models\Personnel;
use App\Services\Personnel\UpdatePersonnel;
use App\Services\Personnel\CreatePersonnel;
use App\Services\Statistics\AttendanceService;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use Carbon\Carbon;


class PersonnelController extends Controller
{
    public function index(): object
    {
        if(request('row') == ''){
            $row = 31;
        }else{
            $row = request('row');
        }

        $year   = request('year');
        $month  = request('month');


//        Cache()->store('key', 'value', now()->addSecond(30));




        $personnel = Personnel::with(['schedule' => function ($q) use ($year, $month, $row) {
            $q->whereYear('date', $year)->whereMonth('date', $month)->get();
        }])->when(request('search') != '', function ($query) use ($row) {
            return $query->where('first_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('last_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('department', 'LIKE', '%' . request('search') . '%')
                ->orWhere('userid', 'LIKE', '%' . request('search') . '%')
                ->paginate($row);
        })->when(request('search') == '', function ($query) use ($row) {
            return $query->paginate($row);
        });



        return PersonnelResource::collection($personnel);
    }


    public function store(Request $request): void
    {
        if ($request->id) {
            (new Updater((new UpdatePersonnel()), $request));
        } else {
            (new Creator((new CreatePersonnel()), $request));
        }
    }


    public function destroy($id): void
    {
        Personnel::where('id', $id)->delete();
    }
}
