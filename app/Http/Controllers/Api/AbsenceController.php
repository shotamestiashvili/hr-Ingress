<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AbsenceResource;
use App\Models\Absence;
use Illuminate\Http\Request;
use App\Services\Reference\Absence\CreateAbsence;
use App\Services\Reference\Absence\UpdateAbsence;
use App\Services\Updater;
use App\Services\Creator;


class AbsenceController extends Controller


{
    public function index()
    {
        $abasence_types = Absence::orderByDesc('created_at')->get();

        return AbsenceResource::collection($abasence_types);
    }


    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateAbsence()), $request));
        } else {
            (new Creator((new CreateAbsence()), $request));
        }
    }

    public function destroy($id)
    {
        Absence::where('id', $id)->delete();
    }
}
