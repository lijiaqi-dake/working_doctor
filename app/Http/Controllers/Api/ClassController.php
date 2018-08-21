<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;

class ClassController extends Controller
{
    public function show(Request $request)
    {
        $user = $this->user();
        $userPhone = User::where([
            'grade' => $request->grade,
            'class' => $request->class,
            'type' => 1,
            'school' => $user->school,
        ])->get();
        $i=0;
        foreach($userPhone as $phone)
        {
            $userPhones[$i++] = [$phone->name,$phone->phone];
        }
// return $user;
        return $userPhones;
    }
}
