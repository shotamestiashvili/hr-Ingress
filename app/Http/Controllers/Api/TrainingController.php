<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrainingResource;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Training\CreateTraining;
use App\Services\Reference\Training\UpdateTraining;

class TrainingController extends Controller
{
    public function create(Request $request)
    {
        Training::create([
            'training' => $request->training,
        ]);
    }

    public function index()
    {
        $showData= Training::all();
        return     TrainingResource::collection($showData);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateTraining()), $request));
        } else {
            (new Creator((new CreateTraining()), $request));
        }
    }

    public function destroy($id)
    {
        Training::where('id', $id)->delete();
    }
}
