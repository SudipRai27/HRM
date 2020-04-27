@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
  <h4><b>Edit Users</b></h4>
    <div class="row">
      <div class="col-sm-10">
      <a href="{{route('list-user')}}" type="button" class="btn btn-danger">Go Back</a><br><br>
      </div>
      @if($user->photo)
      <div class="col-sm-2">
        <span align = "right"><img src="{{URL::to('public/images/user_photos', $user->photo)}}" height="50" width="90"></span>
      </div>
      @endif
    </div>              
    <div class="box"> 
      <div class="box-body">              
        @if ($errors->any())
                <div class = "alert alert-danger alert-dissmissable">
                <button type = "button" class = "close" data-dismiss = "alert">X</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
        <form action="{{route('user-edit-post', $user->id)}}" method="POST" enctype="multipart/form-data">
          <div class="box-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                <b>Full Name: </b>
                <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Enter Full Name">
                <div id="msg" style="color:red;">{{ $errors->first('name') }}</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                <b>Email:</b>
                <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="Enter Email">
                <div id="msg" style="color:red;">{{ $errors->first('email') }}</div>
                </div>
              </div>              
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                <b>Address:</b> 
                <input type="text" name="address" class="form-control" value="{{$user->address}}" placeholder="Enter Address">
                <div id="msg" style="color:red;">{{ $errors->first('address') }}</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                <b>Contact Number </b>: 
                <input type="text" name="contact" class="form-control" value="{{$user->contact}}" placeholder="Enter Contact Number"> 
                <div id="msg" style="color:red;">{{ $errors->first('contact') }}</div>
                </div>
              </div>              
            </div>

            <div class="row">
              <div class ="col-sm-4">
                <div class="form-group">
                <b>Role (User Group): </b>
                <select class="form-control" name="role_id" id="role_id">
                  <option value="">Select</option>
                    @foreach($roles as $index => $d)
                    <option value="{{$d->id}}" @if($d->id == $current_user_role_id) selected @endif>{{$d->role_name}}</option>
                    @endforeach
                 </select>
                 <div id="msg" style="color:red;">{{ $errors->first('role_id') }}</div>
                 </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                <b>Image:</b>
                <input type="file" name="photo" class="form-control">               
                <div id="msg" style="color:red;">{{ $errors->first('photo') }}</div>  
                </div>
              </div>

              <div class="col-sm-4">
                <diV class = "form-group">
                <b>Gender: </b>
                <select class="form-control" name="gender">                 
                    <option value="male" @if($user->gender == 'male') selected @endif>Male</option>
                    <option value="female" @if($user->gender == 'female') selected @endif>Female</option>
                 </select>
                 <div id="msg" style="color:red;">{{ $errors->first('gender') }}</div>  
                </diV>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                <b>Department:</b>
                <select class="form-control" name="department_id" id="department_id">
                  <option value="">Select</option>
                  @foreach($department_list as $index => $value)
                  <option value="{{$index}}" @if($index == $current_user_department_id) selected @endif>{{$value}}</option>
                  @endforeach
                </select>
                <div id="msg" style="color:red;">{{ $errors->first('department_id') }}</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                <b>Job / Designation: </b>
                <select class="form-control" name = "job_id" id="job_id">                  
                  @foreach($job_list as $index => $d)
                   <option value="{{$d->id}}" @if($d->id == $current_user_job_id) selected @endif>{{$d->job_title}}</option>
                  @endforeach
                </select>
                <div id="msg" style="color:red;">{{ $errors->first('job_id') }}</div>
                </div>
              </div>
            </div>

            <div class="row employee">
              <div  class="col-sm-6">
                <div class="form-group">
                <b>Joining Date:</b>
                <input type="text" name="joining_date" class="form-control" value="{{$joining_date}}" placeholder="Enter joining date" id="datepicker"> 
                <div id="msg" style="color:red;">{{ $errors->first('joining_date') }}</div>
                </div>
              </div>
            
              <div class="col-sm-6">
                <div class="form-group">
                <b>Resume: (CV)</b>
                <input type="file" name="resume" class="form-control">
                <div id="msg" style="color:red;">{{ $errors->first('resume') }}</div> 
                </div>
              </div>
              <br>              
            </div>
            <div class="form-group">
            <input type="submit" name="Submit" value="Update" class="btn btn-success">
            </div>
            
          </div>
        {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

  $(document).ready(function() {
          
    $('#department_id').on('change', function() {
      updateJobList();


    })
    function updateJobList()
    {
      var department_id = $('#department_id').val();      
      $('#job_id').html('<option>Loading..</option>');
      $.ajax({
        'method' : 'GET', 
        'url' : '{{route('ajax-get-job-list-from-department-id')}}',
        'data' : {
          'department_id' : department_id
        }

      }).done(function(data){
        $('#job_id').html(data);
      });
    }

  }); 
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
@endsection


