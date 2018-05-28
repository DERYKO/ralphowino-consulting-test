@extends('layouts.app')
<style>
    .card{
        height: 300px;
        width: 200px;
        padding: 3%;
        overflow: auto;
        border: 3px solid black;
    }
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                      <div class="row">
                          <div class="col-md-3">
                              <div class="card">
                                  @foreach($user as $use)
                                      @if(Auth::id()==$use->id)
                                          <h4 class="text-center"><b>{{$use->slug}}'s profile</b></h4>
                                          <p class="text-center"><img src="{{\Illuminate\Support\Facades\Storage::url($use->avatar)}}" height="50px" width="50px" style="border-radius: 10%" class="img-responsive"></p><br/>
                                          <p class="text-center">{{$use->name}}</p>
                                          <p class="text-center">{{$use->email}}</p>
                                          <p class="text-center">{{$use->profile->location}}</p>
                                          <a href="{{url('/editProfile')}}"><button class="btn btn-primary">Edit Profile</button></a>
                                      @endif
                                  @endforeach
                                  <div class="panel panel-default">
                                      <div class="body">
                                          <friend></friend>
                                      </div>
                                  </div>

                              </div>

                          </div>
                          <div class="col-md-9">
                              hello world
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
