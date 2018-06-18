<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;


class profileController extends Controller
{

    public function editProfile()

{
    return view('profiles.editprofile');
}
    public function updateprofile(Request $request)

    {
        $this->validate($request,['location'=>'required','phone'=>'required','email'=>'required','DOB'=>'required','status'=>'required','avatar'=>'required']);
        if($request->hasFile('avatar')){
            Auth::User()->update([
               'avatar'=>$request->avatar->store('public/avatar')
            ]);
        }
        Auth::User()->profile()->update([
        'location'=>$request->location,
        'phone'=>$request->phone,
        'email'=>$request->email,
        'DOB'=>$request->DOB,
        'status'=>$request->status,
    ]);
        $user=User::all();

        return view('home',['user'=>$user]);
    }
    //
}
