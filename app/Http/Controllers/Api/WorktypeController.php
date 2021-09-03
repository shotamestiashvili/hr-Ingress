<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorktypeResource;
use App\Models\Worktype;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Worktype\CreateWorktype;
use App\Services\Reference\Worktype\UpdateWorktype;

class WorktypeController extends Controller
{

    public function index(Request $request)
    {
        // $worktype = Worktype::when(request('search') == 'comp', function ($query) {
        //     return $query->get();
        // })
        //     ->when(request('searchFromWorktype') != '', function ($query) {
        //         return $query->where('code', 'LIKE', '%' . request('search') . '%')
        //             ->orWhere('start', 'LIKE', '%' . request('search') . '%')
        //             ->orWhere('end', 'LIKE', '%' . request('search') . '%')->paginate(20);
        //     })
        //     ->when(request('searchFromWorktype') == '', function ($query) {
        //         return $query->paginate(20);
        //     });

        if ($request->search == 'comp'){
            $worktype =  Worktype::all();
        }elseif($request->searchFromWorktype !== ''){
            $worktype = Worktype::where('code', 'LIKE', '%' . $request->searchFromWorktype . '%')
                        ->orWhere('start', 'LIKE', '%' . $request->searchFromWorktype . '%')
                        ->orWhere('end', 'LIKE', '%' . $request->searchFromWorktype . '%')->paginate(20);
        }elseif($request->searchFromWorktype == ''){
            $worktype =  Worktype::all()->paginate(20);
        }

        return WorktypeResource::collection($worktype);
    }

    public function store(Request $request)
    {

        if ($request->id) {
            (new Updater( (new UpdateWorktype()), $request) );
        } else {
            (new Creator( (new CreateWorktype()), $request) );
        }
    }

    public function destroy($id)
    {
        Worktype::where('id', $id)->delete();
    }
}
