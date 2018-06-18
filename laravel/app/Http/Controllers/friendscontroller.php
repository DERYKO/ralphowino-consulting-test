<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Friendable;
use Illuminate\Http\Request;

class friendscontroller extends Controller
{
    //
    public  function index(){
        $friends=array();
        $users=User::all();
        foreach ($users as $user){
            if($user->isFriendWith(Auth::user())){
                array_push($friends,$user);
            }

        }
        return view('friends.friends',['user'=>$friends]);
    }
    public function findfriends(){
        $friends=array();
        $users=User::all();
        foreach ($users as $user){
            if( !$user->hasBlocked(Auth::user()) && !$user->isBlockedBy(Auth::user()) && !$user->isFriendWith(Auth::user()) && !$user->hasFriendRequestFrom(Auth::user()) && !$user->hasSentFriendRequestTo(Auth::user())){
                array_push($friends,$user);
            }

        }
        return view('friends.findfriends',['user'=>$friends]);
    }
    public function friendrequests(){
        $friends=array();
        $users=User::all();
        foreach ($users as $user){
            if($user->hasSentFriendRequestTo(Auth::user()) ){
                array_push($friends,$user);
            }

        }
        return view('friends.friendrequest',['user'=>$friends]);
    }
    public  function  blocked(){
        $friends=array();
        $users=User::all();
        foreach ($users as $user){
            if($user->isBlockedBy(Auth::user()) ){
                array_push($friends,$user);
            }

        }
        return view('friends.blocked',['user'=>$friends]);
    }
}
