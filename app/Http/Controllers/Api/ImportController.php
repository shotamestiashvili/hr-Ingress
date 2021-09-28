<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\ImportSchedule;
use App\Jobs\CreateOrUpdateSchedule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPersonnel;
use App\Imports\ImportPosition;
use App\Imports\ImportWorktype;
use function Matrix\diagonal;

class ImportController extends Controller
{
    public function importPersonnel(Request $request)
    {

        Excel::import(new ImportPersonnel, $request->import_file);

        return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function importWorktype(Request $request)
    {

        Excel::import(new ImportWorktype, $request->import_file);

        return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function importPosition(Request $request)
    {
        Excel::import(new ImportPosition, $request->import_file);
        return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function importSchedule(Request $request)
    {

        $array = Excel::toCollection(new ImportSchedule, $request->import_file);

        new CreateOrUpdateSchedule($array, $request->selectedYear, $request->selectedMonth);

        return response()->json(['data' => 'Data is uploading, please wait'], 200);

    }

}
