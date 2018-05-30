@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 style="text-transform: capitalize;">{{$user->slug}}'s profile</h4>
                        <hr>
                        <div class="panel-body">
                            <img src="{{\Illuminate\Support\Facades\Storage::url('uploads\social.jpg')}}" alt="No Profile" height="100px" width="100px" style="border-radius: 50%;">
                            <p class="text-center">{{$user->name}}</p>
                            <p class="text-center">{{$user->profile->about}}</p>
                            @if(Auth::id()==$user->id)
                            <p class="text-center"><a href="{{url('/myprofiles/editprofile')}}" class="btn btn-primary">Edit Profile</a></p>
                            @endif
                            @if(Auth::id()!==$user->id)
                            <example :profile_user_id="{{$user->id}}" ></example>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection