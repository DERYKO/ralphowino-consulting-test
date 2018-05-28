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
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="vertical-menu">

                                        <a href="#" class="active"><span class="fa fa-user"> My Friends</span></a>
                                        <a href="{{url('/findFriends')}}"><span class="fa fa-user-plus"> Find Friends</span></a>
                                        <a href="#"><span class="fa fa-bell">  Friend Requests</span></a>
                                    </div>

                                </div>
                                <div class="col-lg-9">
                                    @if(count($user)>0)
                                        @foreach($user as $user1)
                                            @if(Auth::id()==$user1->id)
                                                @else
                                            <div >
                                                <img  src="{{\Illuminate\Support\Facades\Storage::url($user1->avatar)}}" width="20%" height="auto" ><br><p class="fa fa-address-book"> {{$user1->name}}</p><br>
                                                <p class="fa fa-heart"> {{$user1->profile->status}}</p><br>
                                                <p class="fa fa-location-arrow"> {{$user1->profile->location}}</p>
                                                <p>{{$user1->slug}}</p>
                                                <hr>
                                            </div>
                                            @endif
                                        @endforeach
                                        @endif
                                    <div class="panel panel-default">
                                        <div class="body">
                                            <friend></friend>
                                        </div>

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