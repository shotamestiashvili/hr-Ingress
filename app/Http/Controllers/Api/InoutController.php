<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InoutResource;
use App\Models\Inout;

class InoutController extends Controller
{
    public function index()
    {
        $inout = Inout::when(request('search') != '', function ($query) {
            return $query->where('userid', 'LIKE', '%' . request('search') . '%')
                ->orWhere('date', 'LIKE', '%' . request('search') . '%')->paginate(30);
        })
            ->when(request('search') == '', function ($query) {
                return $query->paginate(30);
            });

        return InoutResource::collection($inout);
    }
}
