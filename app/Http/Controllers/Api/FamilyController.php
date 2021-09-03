<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FamilystatusResource;
use App\Models\Familystatus;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Family\CreateFamily;
use App\Services\Reference\Family\UpdateFamily;


class FamilyController extends Controller
{

    public function index()
    {
        $showData= Familystatus::all();
        return     FamilystatusResource::collection($showData);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateFamily()), $request));
        } else {
            (new Creator((new CreateFamily()), $request));
        }
    }

    public function destroy($id)
    {
        Familystatus::where('id', $id)->delete();
    }
}
