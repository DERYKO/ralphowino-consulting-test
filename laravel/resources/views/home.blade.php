@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
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
                          <div class="col-lg-2">
                            <h5>My profile</h5>
                              <img src="public/avatar/male.png"  class="img-responsive">
                          </div>
                          <div class="col-lg-10">
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
