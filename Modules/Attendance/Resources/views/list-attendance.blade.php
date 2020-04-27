@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/sms/datepicker/css/datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Attendance Manager</b></h4>	
	@include('attendance::tabs')
	<?php
		$date = date('Y M d D');
	?>
	<h4 style="color:#FA760E">Todays Date: {{$date}}</h4>
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
				<div class="box-body">
					<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr style="background-color:#333; color:white;">
								<th>SN</th>
								<th>Name</th>
								<th>Attendance</th>
								<th>Attendance Time</th>
								<th>Attendance Check Out Time</th>
								
							</tr>
						</thead>
						<tbody>
						@if(count($todays_attendance))
						<?php
							$i = 1;
						?>
							@foreach($todays_attendance as $index => $d)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$d['name']}}</td>
								@if($d['attendance'] == 'absent')
								<td><p style="color:red;">{{$d['attendance']}}</p></td>	
								@elseif($d['attendance'] == 'present')
								<td><p style="color:green;">{{$d['attendance']}}</p></td>
								@else
								<td><p style="color:orange;">{{$d['attendance']}}</p></td>
								@endif							
								<td>{{$d['attendance_time']}}</td>
								<td>{{$d['attendance_check_out_time']}}</td>
							</tr>
							@endforeach
						@else						
							<br>
							<p align = "center" style="color:red;">No records</p>
						
						@endif
						</tbody>
					</table>
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript" src = "{{ asset('public/sms/datepicker/js/datepicker.min.js')}}"></script>
<script type="text/javascript" src = "{{ asset('public/sms/datepicker/js/i18n/datepicker.en.js')}}"></script>
<script>
var $start = $('#start'),
	$end = $('#end');
	$start.datepicker({
		language: 'en',
		onSelect: function (fd, date) {
			$end.data('datepicker')
				.update('minDate', date)
		}
	})
	$end.datepicker({
		language: 'en',
		onSelect: function (fd, date) {
			$start.data('datepicker')
				.update('maxDate', date)
		}
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#submit').click(function(e){
			e.preventDefault();
			var start_date = $('#start').val();
			var end_date = $('#end').val();
			var user_id = $('#user_id').val();
			if(start_date == '')
			{
				alert('Please Select Start Date');
				$("#start").css("border-color", "red");
				return false;
			}
			else
			{
				$("#start").css("border-color", "green");
			}

			if(end_date == '')
			{
				alert('Please Select End Date');
				$("#end").css("border-color", "red");
				return false;
			}
			else
			{
				$("#end").css("border-color", "green");
			}

			if(user_id == '')
			{
				alert('Please Select Users');
				$("#user_id").css("border-color", "red");
				return false;
			}
			else
			{
				$("#user_id").css("border-color", "green");
			}
			

		});

	});
</script>
@endsection



