<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Friendable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use GetStream\Stream\Client;

class friendablecontroller extends Controller
{
    public function check_status($id){
      $user=User::find($id);
   if(Auth::user()->isFriendWith($user)==1){
       return  ["status"=>"friends"];
   }
   if(Auth::user()->hasFriendRequestFrom($user)) {
       return ["status" => "pending"];

   }
   if(Auth::user()->hasSentFriendRequestTo($user)){
            return  ["status"=>"waiting"];

   }
   if(Auth::user()->hasBlocked($user)){
            return  ["status"=>"blocked"];

        }
   return ["status"=>0];

    }
    public  function addFriend($id){
        $user=User::find($id);
       return Auth::user()->befriend($user);
    }
    public  function acceptFriend($id){
        $user=User::find($id);
        return Auth::user()->acceptFriendRequest($user);
        $client = new Client(uzbecczm6uh8, a2p8a3safphgnef5waxybc9q9s2cnkqvq4ndp7kna7uzdhnygrtpttad6srq6wed);
        $userFeed = $client->feed('user', $id);
        $userFeed->follow('user', Auth::user()->id);

        $userFeed = $client->feed('user', Auth::user()->id);
        $userFeed->follow('user', $id);

    }
    public function blockFriend($id){
        $user=User::find($id);
        return Auth::user()->blockFriend($user);
        $client = new Client(uzbecczm6uh8, a2p8a3safphgnef5waxybc9q9s2cnkqvq4ndp7kna7uzdhnygrtpttad6srq6wed);
        $userFeed = $client->feed('user', $id);
        $userFeed->unfollow('user', Auth::user()->id);

    }
    public function unblockFriend($id){
        $user=User::find($id);
        return Auth::user()->unblockFriend($user);
    }


    public function removeFriend($id){
        $user=User::find($id);
        return Auth::user()->unfriend($user);
        $client = new Client(uzbecczm6uh8, a2p8a3safphgnef5waxybc9q9s2cnkqvq4ndp7kna7uzdhnygrtpttad6srq6wed);
        $userFeed = $client->feed('user', $id);
        $userFeed->unfollow('user',Auth::user()->id);
    }
    public function denyFriend($id){
        $user=User::find($id);
        return Auth::user()->denyFriendRequest($user);
    }
    //
}
