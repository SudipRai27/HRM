<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">

<div class="table-responsive">
@if(count($report_history))
<br>
<table class="table table-bordered table-hover">
	<thead>
		<tr style="background-color:#333; color:white;">
			<th>SN</th>		
			<th>Date</th>	
			<th>Report Created Time</th>																
			<th>File</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>					
	<?php
		$i = 1;
	?>
		@foreach($report_history as $index => $d)
		<tr>
			<td>{{$i++}}</td>		
			<td>{{$d->date}}</td>
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
<br>						
	<div class="alert alert-warning alert-dismissable">
		<h4><i class="icon fa fa-warning"></i>NO DAILY REPORT HISTORY AVAILABLE</h4>
	</div>					
@endif

</div>

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