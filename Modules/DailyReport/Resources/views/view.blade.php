@extends('backend.layouts.submain')
@section('content')
<div class="container" style="background-color:darkred; color:white;">
	<h4>Report Details of the date {{$daily_report->date}} / Uploaded Time : {{$daily_report->time}}</h4>

</div>
<br>
<div class="container">
	<div class="form-group">
	<textarea class="form-control" readonly style="color:red;">
	Work Done: {{$daily_report->work_done}}
	</textarea>
	</div>
	<div class="form-group">
	<textarea class="form-control" readonly style="color:red;">
	Remaining Work: {{$daily_report->remaining_work}}
	</textarea>
	</div>
	<div class="form-group">
	<textarea class="form-control" readonly style="color:red;">
	Todays Learning: {{$daily_report->todays_learning}}
	</textarea>
	</div>
	<div class="form-group">
	<textarea class="form-control" readonly style="color:red;">
	Suggestions: {{$daily_report->suggestions}}
	</textarea>
	</div>
	<div class="form-group">
	<textarea class="form-control" readonly style="color:red;">
	Problems: {{$daily_report->problems}}
	</textarea>
	</div>
</div>
@endsection