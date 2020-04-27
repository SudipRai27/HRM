<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<div class="table-responsive"><br>
<div style="height:30px; background-color:#DEB1A8; color:white;">
Total Days: {{$total_days}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Working Days (exc. Saturday): {{ strlen($working_days) > 0 ? $working_days : '0' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Present Days: {{$present_days}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Leave Days: {{$leave_days}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Absent Days: {{$absent_days}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Saturdays : {{ strlen($saturdays) > 0 ? $saturdays : '0' }}
</div>

<table class="table table-bordered table-hover">
	<thead>
		<tr style="background-color:#333; color:white;">
			<td>SN</td>			
			<td>Date</td>
			<td>Day</td>
			<td>Attendance</td>
			<td>Attendance Time</td>
			<td>Attendance Check Out Time</td>
		</tr>
	</thead>	
	<tbody>
		@if(count($attendance_records))
		<?php 
			$i = 1;
		?>
		@foreach($attendance_records as $index => $record)
		<tr>
			<td>{{$i++}}</td>
			
			<td>{{$record['date']}}</td>
			<td>{{$record['day_name']}}</td>
			<td>
				@if($record['attendance'] == 'present')
					<p style="color:green;">{{$record['attendance']}}</p>
				@elseif($record['attendance'] == 'absent')
					<p style="color:red;">{{$record['attendance']}}</p>
				@elseif($record['attendance'] == 'leave')
					<p style="color:orange;">{{$record['attendance']}}</p>
				@else
					<p style="color:yellow;">{{$record['attendance']}}</p>
				@endif
			</td>
			<td>{{$record['attendance_time']}}</td>
			<td>{{$record['attendance_check_out_time']}}</td>
		</tr>
		@endforeach
		@else
		<p align="center" style="color:red;">No Records Available</p>
		@endif
	</tbody>
</table>
</div>