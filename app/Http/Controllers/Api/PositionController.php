<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Position\CreatePosition;
use App\Services\Reference\Position\UpdatePosition;

class PositionController extends Controller
{

    public function index()
    {
        $position = Position::when(request('search') != '', function ($query) {
            return $query->where('position_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('code', 'LIKE', '%' . request('search') . '%')
                ->paginate(20);
        })

            ->when(request('search') == '', function ($query) {
                return $query->paginate(20);
            });

        return PositionResource::collection($position);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdatePosition()), $request));
        } else {
            (new Creator((new CreatePosition()), $request));
        }
    }

    public function destroy($id)
    {
        Position::where('id', $id)->delete();
    }
}
