<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\User;

class ProfilesController extends Controller
{
    protected function index($slug)
    {
        $user=User::where('slug',$slug)->first();
        return View('profiles.myprofile')->with('user',$user);
    }
    public  function editprofile(){
        return View('profiles.editmyprofile');
    }
    public function updateprofile(Request $request){

        $this->validate($request,['location'=>'required','status'=>'required','about'=>'required','avatar'=>'required']);

        Auth::user()->profile()->update([
           'location'=>$request->location,
           'status'=>$request->status,
           'about'=>$request->about,
        ]);
        if($request->hasFile('avatar')){
            Auth::user()->update([
                'avatar'=>$request->avatar->store('public/avatars')
            ]);
        }
        Session::flash('success','Profile updated');
        $user=User::all();
        return view('home',['user'=>$user]);
    }
}
