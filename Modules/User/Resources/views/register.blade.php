@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Add Users</b></h4>
	<a href="{{route('list-user')}}" type="button" class="btn btn-danger">Go Back</a><br><br>
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
				<form action="{{route('user-create-post')}}" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
								<b>Full Name: </b>
								<input type="text" name="name" class="form-control" value="{{Input::old('name')}}" placeholder="Enter Full Name">
								<div id="msg" style="color:red;">{{ $errors->first('name') }}</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<b>Email:</b>
								<input type="email" name="email" class="form-control" value="{{Input::old('email')}}" placeholder="Enter Email">
								<div id="msg" style="color:red;">{{ $errors->first('email') }}</div>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
								<b>Address:</b> 
								<input type="text" name="address" class="form-control" value="{{Input::old('address')}}" placeholder="Enter Address">
								<div id="msg" style="color:red;">{{ $errors->first('address') }}</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<b>Contact Number </b>: 
								<input type="text" name="contact" class="form-control" value="{{Input::old('contact')}}" placeholder="Enter Contact Number"> 
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
								   	<option value="{{$index}}" @if(Input::old('role_id') == $index) selected @endif>{{$d}}</option>
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
								   	<option value="male" @if(Input::old('gender') == 'male') selected @endif>Male</option>
								   	<option value="female" @if(Input::old('gender') == 'female') selected @endif>Female</option>
							   </select>
							   <div id="msg" style="color:red;">{{ $errors->first('gender') }}</div>	
								</diV>
							</div>
						</div>

						<div class="row employee">
							<div class="col-sm-6">
								<div class="form-group">
								<b>Department:</b>
								<select class="form-control" name="department_id" id="department_id">
									<option value="">Select</option>
									@foreach($department_list as $index => $value)
									<option value="{{$index}}" @if(Input::old('department_id') == $index) selected @endif>{{$value}}</option>
									@endforeach
								</select>
								<div id="msg" style="color:red;">{{ $errors->first('department_id') }}</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<b>Job / Designation: </b>
								<select class="form-control" name = "job_id" id="job_id">
									<option value="">Please Select Department First</option>	
								</select>
								<div id="msg" style="color:red;">{{ $errors->first('job_id') }}</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div  class="col-sm-6">
								<div class="form-group">
								<b>Joining Date:</b>
								<input type="text" name="joining_date" class="form-control" value="{{Input::old('joining_date')}}" placeholder="Enter joining date" id="datepicker"> 
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
						</div>
						<div class="form-group">
						<input type="submit" name="Submit" value="Create" class="btn btn-success">
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
			
		updateJobList();

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


