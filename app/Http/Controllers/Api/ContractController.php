<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Contract\CreateContract;
use App\Services\Reference\Contract\UpdateContract;

class ContractController extends Controller
{
    public function index()
    {
        $showData= Contract::all();
        return ContractResource::collection($showData);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateContract()), $request));
        } else {
            (new Creator((new CreateContract()), $request));
        }
    }
    public function destroy($id)
    {
        Contract::where('id', $id)->delete();
    }


}
