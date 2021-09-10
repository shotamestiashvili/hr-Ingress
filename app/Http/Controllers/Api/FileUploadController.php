<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class FileUploadController extends Controller
{
    public function store (Request $request)
    {
        $data = $request->validate([
            'avatar'   => ['image', 'dimensions:max_width=1000,max_height=1000'],
            'name'     => ['required', 'string'],
        ]);
        
        $file = $request->file('avatar');
        $name = '/avatars/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $data['avatar'] = $name;

        $image  =  Image::create($data);

        return new ImageResource($image);
    }
}
