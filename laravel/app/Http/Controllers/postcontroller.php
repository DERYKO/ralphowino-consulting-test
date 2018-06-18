<?php

namespace App\Http\Controllers;

use GetStream\Stream\Client;
use Illuminate\Http\Request;
use App\Post;
use Auth;
use Illuminate\Support\Facades\Config;
class postcontroller extends Controller
{
    public function fetch_feeds()
    {
        $page_number = 1;
        $user_id = Auth::user()->id;
        $feedActivityCount = 10;
        $offset = 0;
        if($page_number != 1){
            $offset = $page_number * $feedActivityCount;
        }
        // Instantiate a feed object
        $client = new Client('uzbecczm6uh8', 'a2p8a3safphgnef5waxybc9q9s2cnkqvq4ndp7kna7uzdhnygrtpttad6srq6wed');
        // Instantiate a feed object
        $userFeed = $client->feed('user', $user_id);
        // Get the latest activities for this user's personal feed, based on who they are following.
        $response = $userFeed->getActivities($offset, $feedActivityCount);
        $posts = array();
        // Fetch posts per activity
        foreach ($response['results'] as $key => $activity) {
            $post_ref = explode(":",$activity['object']);
            $post = Post::with(['user'])->find((int)$post_ref[0]);
            $posts[$key]['activity'] = $activity;
            $posts[$key]['post'] = $post;
        }
        return response()->json(['posts' => $posts, 'next_page' => ++$page_number]);
    }

    public function save_post(Request $request)
    {
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->body = $request->body;
        $post->save();
        $client = new Client('uzbecczm6uh8', 'a2p8a3safphgnef5waxybc9q9s2cnkqvq4ndp7kna7uzdhnygrtpttad6srq6wed');
        $userFeed = $client->feed('user', $post->user_id);
        $data = [
          "actor"=>Auth::user()->name,
           "verb"=>"like",
           "object"=>$post->user_id,
            "tweet"=>$post->body,
            ];
        $userFeed->addActivity($data);
        $response = $userFeed->getActivities(0, 2);
        return response()->json(['post' => $post,'activityfeed'=>$response]);
    }

    public function delete_post($post_id)
    {
        Post::destroy($post_id);
        $user_id = Auth::user()->id;
        $activity_id = $post_id;
        if ($activity_id && $user_id) {
            $client = new Client('uzbecczm6uh8', 'a2p8a3safphgnef5waxybc9q9s2cnkqvq4ndp7kna7uzdhnygrtpttad6srq6wed');
            $userFeed = $client->feed('user', $user_id);
            // Remove an activity by its id
            $userFeed->removeActivity($activity_id);
        }
    }
}
