<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<div class="table-responsive"><br>
@if(count($leave_history))
<?php 
	$i = 1;
?>

<table class="table table-bordered table-hover">
	<thead>
		<tr style="background-color:#333; color:white;">
			<th>SN</th>			
			<th>Date</th>
			<th>Day</th>
			<th>Attendance</th>			
		</tr>
	</thead>	
	<tbody>
		@foreach($leave_history as $index => $record)
		<tr>
			<td>{{$i++}}</td>			
			<td>{{$record['date']}}</td>
			<td>{{$record['day_name']}}</td>
			<td>	
			@if($record['attendance'] == 'leave')							
			<p style="color:red;">{{$record['attendance']}}</p>				
			@else
			<p style="color:orange;">{{$record['attendance']}}</p>				
			@endif
			</td>					
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-danger alert-dismissable">
	<h4><i class="icon fa fa-warning"></i>NO LEAVE REQUEST AVAILABLE</h4>
</div>	
@endif
	
</div>