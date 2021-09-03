<?php

namespace App\Services\Personnel;


use App\Http\Interfaces\UpdaterInterface;
use App\Models\Personnel;

class UpdatePersonnel implements UpdaterInterface
{

    public function update($request)
    {
        Personnel::where('id', $request->id)
                 ->update([
                'id' => $request->id,
                'userid' => $request->userid,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'personal_id' => $request->personal_id,
                'birth_day' => $request->birth_day,
                'gender' => $request->gender,
                'address' => $request->address,
                'retirement' => $request->retirement,
                'family_status' => $request->family_status,
                'education' => $request->education,
                'contact_info' => $request->contact_info,
                'position' => $request->position,
                'department' => $request->department,
                'head' => $request->head,
                'subordinate_stuff' => $request->subordinate_stuff,
                'military_info' => $request->military_info,
                'phone' => $request->phone,
                'email' => $request->email,
                'author' => $request->author,
            ]);
    }
}
