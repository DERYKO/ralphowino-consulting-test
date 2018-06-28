@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Your Profile</div>

                    <div class="panel-body">
                     <form method="post" action="{{url('/editProfile/edit')}}" enctype="multipart/form-data">
                         {{ csrf_field() }}
                         <div class="form-group">
                             <label for="DOB">Date Of Birth</label>
                             <input type="date" class="form-control" name="DOB" required/>
                         </div>
                         <div class="form-group">
                             <label for="location">Location</label>
                             <input type="text" class="form-control" name="location" required/>
                         </div>
                         <div class="form-group">
                             <label  for="email">Email</label>
                             <input type="email" class="form-control" name="email" required/>
                         </div>
                         <div class="form-group">
                             <label  for="phone">Phone</label>
                             <input type="number" class="form-control" name="phone" required/>
                         </div>
                         <div class="form-group">
                             <label  for="status">Status</label>
                             <select class="form-control" name="status" >
                                 <option value="single" selected>Single</option>
                                 <option value="in_a_relationship">In a Relationship</option>
                                 <option value="complicated">Complicated</option>
                                 <option value="single">Single</option>
                                 <option value="married">Married</option>
                                 <option value="other">Other</option>
                             </select>
                         </div>
                    <div class="form-group">
                        <label  for="avatar">Profile Image</label>
                        <input type="file" class="form-control" accept="image/*" name="avatar" required/>
                    </div>
                         <div class="form-group">
                             <button type="submit" class="btn btn-primary btn-lg">Update Profile</button>
                         </div>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
