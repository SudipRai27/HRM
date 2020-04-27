@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<?php
	$controller = new App\Http\Controllers\HelperController;
	$user_type = $controller->checkUserType();
?>
<div class="row">
	<div class="col-xs-12">
	<h4><b>Edit Daily Report </b></h4>
	<a href="{{route('list-report')}}" type="button" class="btn btn-danger">Go Back</a><br><br>
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
				<form enctype="multipart/form-data" method="POST" action="{{route('edit-report-post', $daily_report->id)}}">
					@if($user_type == 'superadmin')
					<div class="form-group">
						<b>User:</b>
						<select name='user_id' class="form-control">
							<option value="">Select</option>
							@foreach($users as $index => $d)
							<option value="{{$d->id}}" @if($daily_report->user_id == $d->id) selected @endif>{{$d->name}}</option>
							@endforeach
						</select>
						<div id="msg" style="color:red;">{{ $errors->first('user_id') }}</div>
					</div>
					@endif
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<b>Date:</b>
								<input type="text" name="date" class="form-control" id="datepicker" value="{{$controller->changeDateFormatfromHyphenToSlash($daily_report->date)}}" placeholder="Select Date">
								<div id="msg" style="color:red;">{{ $errors->first('date') }}</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<b>File: (If any file to upload)</b>
								<input type="file" name="file" class="form-control">
								<div id="msg" style="color:red;">{{ $errors->first('file') }}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<b>Work Done:</b>
								<textarea class="form-control" name="work_done" rows="5" placeholder="Your Answer">{{$daily_report->work_done}}</textarea>
								<div id="msg" style="color:red;">{{ $errors->first('work_done') }}</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<b>Remaining Work:</b>
								<textarea class="form-control" name="remaining_work" rows="5" placeholder="Your Answer">{{$daily_report->remaining_work}}</textarea>
								<div id="msg" style="color:red;">{{ $errors->first('remaining_work') }}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<b>Todays Learning:</b>
								<textarea class="form-control" name="todays_learning" rows="5" placeholder="Your Answer">{{$daily_report->todays_learning}}</textarea>
								<div id="msg" style="color:red;">{{ $errors->first('todays_learning') }}</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<b>Suggestions, Complaints, Feedbacks:</b>
								<textarea class="form-control" name="suggestions" rows="5" placeholder="Your Answer">{{$daily_report->suggestions}}</textarea>
								<div id="msg" style="color:red;">{{ $errors->first('suggestions') }}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<b>If you faced any problems: </b>
								<textarea class="form-control" name="problems" rows="5" placeholder="Your Answer">{{$daily_report->problems}}</textarea>
								<div id="msg" style="color:red;">{{ $errors->first('problems') }}</div>
							</div>
						</div>		
						<div class="col-sm-6">
						<div class="form-group">
						<br><br><br><br>
						<input type="submit" name="" value="Update" class="btn btn-success">
						</div>
						</div>				
					</div>					
					{{csrf_field()}}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  
@endsection