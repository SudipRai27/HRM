@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/lity.min.css')}}">
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Daily Report Manager</b></h4>	
	@include('dailyreport::tabs')
	<?php
		$date = date('Y M d D');
	?>
	<h4 style="color:#FA760E">Todays Date: {{$date}}</h4>
		<div class="box"> 
			<div class="box-body">														
				<div class="box-body">
					<div class="table-responsive">
					@if(count($daily_report))
					<table class="table table-bordered table-hover">
						<thead>
							<tr style="background-color:#333; color:white;">
								<th>SN</th>
								<th>Name</th>
								<th>Report Created Time</th>																
								<th>File</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>					
						<?php
							$i = 1;
						?>
							@foreach($daily_report as $index => $d)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$d->name}}</td>
								<td style="color:green;">{{$d->time}}</td>
								<td>
									@if($d->file)	
									{{$d->file}} &nbsp;&nbsp;
									<a href="{{route('download-report-file', $d->id)}}" class="btn btn-success" type="button">Download File</a>
									@else
									<p style = "color:red;">No File Available</p>
									@endif

								</td>
								<td>																
								<a href = "{{route('view-report', $d->id)}}" data-lity><button data-toggle="tooltip" title="" class="btn btn-warning btn-flat" type="button" data-original-title="View"> <i class="fa fa-fw fa-file"></i></button>
								<a href = "{{route('edit-report', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-info btn-flat" type="button" data-original-title="Edit"> <i class="fa fa-fw fa-edit"></i></button></a>									
		                        <a href = "{{route('delete-report', $d->id)}}" onclick="return ConfirmDelete();"><button data-toggle="tooltip" title="" class="btn btn-danger btn-flat" type="button" data-original-title="Delete"> <i class="fa fa-fw fa-trash"></i></button></a>
							</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else						
						<div class="alert alert-warning alert-dismissable">
	  					<h4><i class="icon fa fa-warning"></i>NO DAILY REPORT AVAILABLE FOR TODAY</h4>
	 					</div>					
						@endif
						
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript" src="{{asset('public/sms/assets/js/lity.min.js')}}"></script>
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



