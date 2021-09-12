<?php

namespace App\Services\Personnel;


use App\Http\Interfaces\CreatorInterface;
use App\Models\Personnel;
use App\Services\Statistics\AttendanceService;

class CreatePersonnel implements CreatorInterface
{

    public  function create($request)
    {
        (new AttendanceService())->newUserInout($request->userid);

        Personnel::create([
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
            'food'=> $request->food,
            'ensuarence' => $request->ensuarence,
            'additional' => $request->additional,
            'bank_account' => $request->bank_account,
            'companyid' => $request->companyid,
            'additional'  => $request->additional,
            'avatar_url' => '/storage/'.$request->avatar_url
        ]);
    }
}
