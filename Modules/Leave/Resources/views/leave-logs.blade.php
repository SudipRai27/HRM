@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/lity.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/sms/datepicker/css/datepicker.min.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Leave Request Manager</b></h4>					
	@include('leave::tabs')	
		<div class="box"> 
			<div class="box-body">				
				<div class="row">
					
					<?php
						$controller = new App\Http\Controllers\HelperController;
						$user_type = $controller->checkUserType();
						$i = 1;
					?>
					<input type="hidden" id="user_type" value="{{$user_type}}">
					@if($user_type == 'superadmin')
					<div class="col-sm-6">
						<select class="form-control" id="user_id" name="user_id">
							<option value="">Select</option>
							@foreach($user as $index => $d)
							<option value="{{$d->id}}">{{$d->name}}</option>
							@endforeach
						</select>						
					</div>
					@else
						@if(count($leave_logs))						
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
					@endif					
				</div>	
				<div id="leave-logs"></div>														
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript">
	$(document).ready(function(){

		$('#user_id').change(function(){
			var user_id = $('#user_id').val();
			$('#leave-logs').html('<p align="center"><img src = {{asset('public/images/giphy.gif')}}></p>')
			$.ajax({
				'type': 'GET', 
				'data': {
					'user_id': user_id
				}, 
				'url': '{{route('ajax-get-leave-logs-from-user-id')}}'
			}).done(function(data){
				$('#leave-logs').html(data);
			});
		});		

	});
</script>
@endsection

