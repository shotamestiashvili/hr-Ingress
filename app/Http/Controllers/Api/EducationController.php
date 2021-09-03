<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Education\CreateEducation;
use App\Services\Reference\Education\UpdateEducation;

class EducationController extends Controller
{
    public function create(Request $request)
    {
        Education::create([
            'education' => $request->education,
        ]);
    }

    public function index()
    {
        $showData= Education::all();
        return     EducationResource::collection($showData);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateEducation()), $request));
        } else {
            (new Creator((new CreateEducation()), $request));
        }
    }

    public function destroy($id)
    {
        Education::where('id', $id)->delete();
    }

}
