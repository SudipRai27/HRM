@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<style type="text/css">
	.btn-pref {
		width: 600px;
	}
	.well {
		width: 600px;
	}

	#user-image {
		width: 200px;
		height: 200px;
		border-radius: 2em;
	}	
</style>
@endsection
@section('content')
<h4><b>User Detail</b></h4>
<a href="{{route('list-user')}}" type="button" class="btn btn-danger">Go Back</a><br><br>
<div class="row table-responsive">
	<div class="col-sm-3">
	@if($user->photo)
	<br>
	<img src = "{{ URL::to('public/images/user_photos/', $user->photo)}}" id="user-image"><br><br>
	@endif
	</div>
	<div class="col-sm-9">
		<div class="col-lg-6 col-sm-6">
		    <div class="card hovercard">
		        
		    </div>
		    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
		        <div class="btn-group" role="group">
		            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
		                <div class="hidden-xs">User Details</div>
		            </button>
		        </div>
		        <div class="btn-group" role="group">
		            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
		                <div class="hidden-xs">Documents</div>
		            </button>
		        </div>
		        
		    </div>

		    <div class="well">
		      <div class="tab-content">
		        <div class="tab-pane fade in active" id="tab1">
		          <h4><i>{{$user->name}}</i></h4>
		          Email: <input type="text" name="" class="form-control" value="{{$user->email}}"  readonly>
		          Address: <input type="text" name="" class="form-control" value="{{$user->address}}"  readonly>
		          Contact: <input type="text" name="" class="form-control" value="{{$user->contact}}"  readonly>
		          Gender: <input type="text" name="" class="form-control" value="{{$user->gender}}"  readonly>
		          Group / User : <input type="text" name="" class="form-control" value="{{$user->role_name}}"  readonly>
		          Joining Date:  <input type="text" name="" class="form-control" value="{{$user_details->joining_date}}"  readonly>
		          Department:  <input type="text" name="" class="form-control" value="{{$user_details->department_name}}"  readonly>
		          Job Title:  <input type="text" name="" class="form-control" value="{{$user_details->job_title}}"  readonly>
		        </div>	
		        <div class="tab-pane fade in" id="tab2">
		          <h4><i>CV / Resume</i></h4>
		          @if($user_details->resume)
		          {{$user_details->resume}}<br><br>
		          <a href="{{route('download-user-cv', $user_details->user_id)}}" target = "_blank" class="btn btn-success" type="button">View CV</a>
		          @else
		          <p style="color:red;">No CV Available at the Moment. Please Upload</p>
		          @endif
		        </div>
		        
		      </div>
		    </div>
		    
		    </div>
	</div>
</div>    
@endsection
@section('custom-js')
<script type="text/javascript">
	$(document).ready(function() {
	$(".btn-pref .btn").click(function () {
	    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
	    // $(".tab").addClass("active"); // instead of this do the below 
	    $(this).removeClass("btn-default").addClass("btn-primary");   
	});
});
</script>
@endsection