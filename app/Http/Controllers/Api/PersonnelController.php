<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use App\Models\Inout;
use App\Models\Personnel;
use App\Services\Personnel\UpdatePersonnel;
use App\Services\Personnel\CreatePersonnel;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;


class PersonnelController extends Controller
{
    public function index(): Object
    {
        $personnel = Personnel::when(request('search') != '', function ($query) {
            return $query->where('first_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('last_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('department', 'LIKE', '%' . request('search') . '%')
                ->orWhere('userid', 'LIKE', '%' . request('search') . '%')->paginate(30);
        })
            ->when(request('search') == '', function ($query) {
                return $query->paginate(30);
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
        $userid = Personnel::where('id', $id)->value('usreid');
        Inout::where('userid', $userid)->delete();
        Personnel::where('id', $id)->delete();
    }
}
