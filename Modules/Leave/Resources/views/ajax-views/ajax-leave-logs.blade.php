<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<div class="table-responsive"><br>
@if(count($leave_logs))
<?php 
	$i = 1;
?>

<table class="table table-bordered table-hover">
	<thead>
		<tr style="background-color:#333; color:white;">
			<td>SN</td>			
			<td>Dates</td>
			<td>Status</td>
			<td>Description</td>			
		</tr>
	</thead>	
	<tbody>
		@foreach($leave_logs as $index => $log)
		<tr>
			<td>{{$i++}}</td>			
			<td>{{$log->date_range}}</td>
			<td>
			@if($log->status == 'rejected')
			<p style="color:red;">{{$log->status}}</p>
			@else
			<p style="color:green;">{{$log->status}}</p>
			@endif
			</td>
			<td>{{$log->description}}</td>			
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-danger alert-dismissable">
	<h4><i class="icon fa fa-warning"></i>NO LEAVE LOGS AVAILABLE</h4>
</div>	
@endif
	
</div>