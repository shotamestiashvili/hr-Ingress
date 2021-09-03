<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QualificationResource;
use App\Models\Qualification;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Qualification\CreateQualification;
use App\Services\Reference\Qualification\UpdateQualification;

class QualificationController extends Controller
{

    public function index()
    {
        $showData= Qualification::all();
        return     QualificationResource::collection($showData);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateQualification()), $request));
        } else {
            (new Creator((new CreateQualification()), $request));
        }
    }

    public function destroy($id)
    {
        Qualification::where('id', $id)->delete();
    }
}
