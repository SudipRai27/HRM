@extends('backend.layouts.submain')
@section('content')
<div class="box-body">
	<div class="container">
	<div style="background-color:darkred; color:white; height:30px;">
	<h4>Leave Details</h4>
	</div>
	<br>
	<input type="text" name="" class="form-control" value="Date : {{$leave_request->start_date}} - {{$leave_request->end_date}}" readonly style="color:green;"><br>
	<textarea class="form-control" rows = "5" readonly style="color:green;">Reason / Description: {{$leave_request->description}}</textarea><br>
	<input type="text" name="" class="form-control" value="Status: {{$leave_request->status}}" readonly style="color:green;"><br>	
	@if($leave_request->status_updated_date_time)
	<input type="text" name="" class="form-control" value="Status Updated at: {{$leave_request->status_updated_date_time}}" readonly style="color:green;"><br>	
	@endif
	</div>
</div>
@endsection