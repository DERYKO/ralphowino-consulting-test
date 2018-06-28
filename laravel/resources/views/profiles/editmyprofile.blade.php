@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit my profile</div>

                    <div class="panel-body">
                        <form action="{{url('/editmyprofile/update')}}" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="location" >Location</label>
                                <input type="text" class="form-control" name="location" required>
                            </div>
                            <div class="form-group">
                                <label for="status" >Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Single" selected>Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Complicated">Complicated</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="about" >About Me</label>
                                <textarea type="text" cols="7" rows="3" maxlength="300" class="form-control" name="about" required>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="avatar" >Profile Image</label>
                                <input type="file" class="form-control" name="avatar" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update Profile</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
