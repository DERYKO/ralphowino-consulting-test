@extends('layouts.app')
<style >
    .vertical-menu {
        width: 200px;
        height: 150px;
        overflow-y: auto;
    }

    .vertical-menu a {
        background-color: #eee; /* Grey background color */
        color: black; /* Black text color */
        display: block; /* Make the links appear below each other */
        padding: 12px; /* Add some padding */
        text-decoration: none; /* Remove underline from links */
    }

    .vertical-menu a:hover {
        background-color: #ccc; /* Dark grey background on mouse-over */
    }

    .vertical-menu a.active {
        background-color: #4CAF50; /* Add a green color to the "active/current" link */
        color: white;
    }

</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="vertical-menu">

                                        <a href="{{url('/friends')}}" class="active"><span class="fa fa-user"> My Friends</span></a>
                                        <a href="{{url('/findFriends')}}"><span class="fa fa-user-plus"> Find Friends</span></a>
                                        <a href="{{url('/friendrequests')}}"><span class="fa fa-bell">  Friend Requests</span></a>
                                        <a href="{{url('/blockedrequests')}}"><span class="fa fa-ban"> Blocked</span></a>
                                    </div>

                                </div>
                                <div class="col-lg-8">
                                    <div class="panel-body">
                                        @if(count($user)>0)
                                            @foreach($user as $friend)
                                                @if(Auth::id()!==$friend->id)
                                                    <div style="overflow: auto">
                                                        <div class="body" style="border: 1px solid whitesmoke">
                                                            <p class="text-center" style="text-transform: capitalize">{{$friend->slug}}'s Profile</p>
                                                            <p class="text-center"><img src="{{\Illuminate\Support\Facades\Storage::url('upload/male.png')}}" alt="No Profile" height="100px" width="100px" style="border-radius: 50%;"></p>
                                                            <p class="text-center">{{$friend->name}}</p>
                                                            <example :profile_user_id="{{$friend->id}}" ></example>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="panel-body">
                                                <h2>No more friends to add</h2>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection