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
                                        <a href="#"><span class="fa fa-user-plus"> Find Friends</span></a>
                                        <a href="#"><span class="fa fa-bell">  Friend Requests</span></a>
                                    </div>

                                </div>
                                <div class="col-lg-9">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection