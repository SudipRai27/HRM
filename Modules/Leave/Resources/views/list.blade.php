@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/lity.min.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Leave Request Manager</b></h4>					
	@include('leave::tabs')
	<select class="form-control" id="leave_status">
		<option value="all">Select Leave Type</option>
		<option value="ongoing" @if($status == 'ongoing') selected @endif>Ongoing</option>
		<option value="approved" @if($status == 'approved') selected @endif>Approved</option>
		<option value="rejected" @if($status == 'rejected') selected @endif>Rejected</option>
	</select>
	<br>
		<div class="box"> 
			<div class="box-body">				
				<div class="table-responsive">
					@if(count($leave_request))
					<?php 
						$i =1; 
						$controller = new App\Http\Controllers\HelperController;						
					?>					
			        <table class="table table-bordered table-hover">        
						<thead>
							<tr style="background-color:#333; color:white;">
							<th>SN</th>
							<th>Name</th>
							<th>Date(From - To )</th>
							<th>Status</th>
							<th>Status Updated Date / Time</th>												
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($leave_request as $index => $d)
							<tr>
							<td>{{$i++}}</td>
							<td>{{$d->name}}</td>
							<td>{{$d->start_date .' - '. $d->end_date}}</td>
							<td>
							@if($d->status == 'ongoing')
							<p style="color:orange;">{{$d->status}}</p>
							@elseif($d->status == 'approved')
							<p style="color:green;">{{$d->status}}</p>
							@elseif($d->status == 'rejected')
							<p style="color:red;">{{$d->status}}</p>
							@endif
							</td>
							<td>
							@if($d->status_updated_date_time)
								<p style="color:green;">{{$d->status_updated_date_time}}</p>
							@else
								<p style= "color:red;">unapproved</p>
							@endif							
							</td>														
							<td>								
								<a href="{{route('approve-leave', $d->id)}}" type="button" class="btn btn-success" onclick="return ConfirmApprove();">Approve</a>
								<a href="{{route('reject-leave', $d->id)}}" type="button" class="btn btn-danger" onclick="return ConfirmReject();">Reject</a>			
								<a href = "{{route('view-leave', $d->id)}}" data-lity><button data-toggle="tooltip" title="" class="btn btn-default btn-flat" type="button" data-original-title="View"> <i class="fa fa-fw fa-file"></i></button>
								<a href = "{{route('edit-leave', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-info btn-flat" type="button" data-original-title="Edit"> <i class="fa fa-fw fa-edit"></i></button></a>									
		                        <a href = "{{route('delete-leave', $d->id)}}" onclick="return ConfirmDelete();"><button data-toggle="tooltip" title="" class="btn btn-warning btn-flat" type="button" data-original-title="Delete"> <i class="fa fa-fw fa-trash"></i></button></a>
							</td>
							</tr>
						@endforeach
						</tbody>       								
			        </table>
					@else
					<div class="alert alert-danger alert-dismissable">
	  					<h4><i class="icon fa fa-warning"></i>NO DATA AVAILABLE</h4>
	 				</div>
					@endif
						
				</div>								
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript" src="{{asset('public/sms/assets/js/lity.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#leave_status').change(function() {
			var leave_status = $('#leave_status').val();
			var current_url = $('#current_url').val();
			current_url += '?status='+leave_status;
			window.location.replace(current_url);
		})
	})
</script>
<script>
    function ConfirmApprove()
    {
      var x = confirm("Are you sure to approve leave request ? In doing so the attendance will be updated.");
      if (x)
          return true;
      else
          return false;
    }
</script> 
<script>
    function ConfirmReject()
    {
      var x = confirm("Are you sure to reject leave request?");
      if (x)
          return true;
      else
          return false;
    }
</script> 
<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
          return false;
    }
</script> 
@endsection
