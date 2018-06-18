<?php

namespace App\Http\Controllers;

use App\User;
use Friendable;
use Messagable;
use Illuminate\Http\Request;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class messagingcontroller extends Controller
{

    public function index(){
        return View('messages.messagespage');
    }
    public function friendsMessages(){
     $allusers=User::all();
     $returnallFriends=[];
     foreach ($allusers as $users){
         if($users->isFriendWith(Auth::user())){
             array_push($returnallFriends,$users);
         }
        }
     return $returnallFriends;
    }
    public function show($user_id = false){
        $threads = null;
        $threads_count = 10;
        if ($user_id){
            $threads = Thread::with('users')->forUser($user_id)->latest('updated_at')->paginate($threads_count);
        } else {
            $threads = Thread::with('users')->forUser(Auth::user()->id())->latest('updated_at')->paginate($threads_count);
        }

        foreach ($threads as $thread){
            $latest_message = Thread::find($thread->id)->getLatestMessageAttribute();
            $user = User::find($latest_message->user_id);

            $thread->latest_message = $latest_message;
            $thread->user = $user;
        }

        return response()->json($threads);
    }
    public function create_thread(Request $request){

        $thread = Thread::create([
            'subject' => $request['subject'],
        ]);

        Message::create([
            'thread_id' => $thread->id,
            'user_id' => $request['sender_id'],
            'body' => $request['message'],
        ]);

        // Add  all thread initiator
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => $request['sender_id'],
            'last_read' => new Carbon,
        ]);

        // Add the Recipients
        foreach ($request->participants as $participant){
            $thread->addParticipant($participant);
        }

        $threads = Thread::with('users')->forUser($request['sender_id'])->latest('updated_at')->get();
        return response()->json($threads);
    }
    public function get_all_participants($thread_id){
        $thread = Thread::find($thread_id);
        $participants = Participant::with(['user'])->where('thread_id', $thread_id)->get();
        return response()->json(['participants' => $participants, 'thread' => $thread]);
    }
    public function removeParticipant($thread_id)
    {
        $user_id=Auth::user()->id;
        $thread = Thread::find($thread_id);
        $thread->removeParticipant($user_id);

        $participants = Participant::with(['user'])->where('thread_id', $thread_id)->get();

        // Archive thread if the last user has left
        if(count($participants) < 1){
            $thread->delete();
        }
        return response()->json($participants);
    }
    public  function fetchUnread($id){
        $unreadMessages = 0;

        $threads = Thread::forUser($id)->latest('updated_at')->get();

        foreach ($threads as $thread){
            $unread_count = $thread->userUnreadMessagesCount($id);
            $unreadMessages += $unread_count;
        }

        return response()->json($unreadMessages);

    }
    public function fetch_messages($thread_id){
        $messagesPerPage = 10;
        $user_id=Auth::user()->id;
        $messages = Message::with(['user'])->where('thread_id', $thread_id)->orderBy('created_at', 'desc')->paginate($messagesPerPage);

        $thread = Thread::find($thread_id);
        $thread->markAsRead($user_id);
        return response()->json($messages);
    }
    public function save_message(Request $request){
        $message = new Message();
        $message->thread_id = $request->thread_id;
        $message->user_id = Auth::user()->id;
        $message->body = $request->message;

        $message->save();

        $user = User::find($message->user_id);
        $message->user = $user;
        return response()->json($message);
    }
}
