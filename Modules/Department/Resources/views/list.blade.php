@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Department Manager</b></h4>			
	<a href="{{route('create-department')}}" type="button" class="btn btn-success">Create Department</a><br><br>
		<div class="box"> 
			<div class="box-body">				
				<div class="table-responsive">
					@if(count($department))
						<?php  $i =1; ?>						
			        <table class="table table-bordered table-hover">        
						<thead>
							<tr style="background-color:#333; color:white;">
							<th>SN</th>
							<th>Department Name</th>							
							<th>Description</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($department as $index => $d)
							<tr>
							<td>{{$i++}}</td>
							<td>{{$d->department_name}}</td>
							<td>{{$d->description }}</td>
							<td>
								<a href = "{{route('edit-department', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-primary btn-flat" type="button" data-original-title="Edit"> <i class="fa fa-fw fa-edit"></i></button></a>
		                        <a href = "{{route('delete-department', $d->id)}}" onclick="return ConfirmDelete();"><button data-toggle="tooltip" title="" class="btn btn-danger btn-flat" type="button" data-original-title="Delete"> <i class="fa fa-fw fa-trash"></i></button></a>
							</td>
							</tr>
						@endforeach
						</tbody>       								
			        </table>
					@else
					<div class="alert alert-warning alert-dismissable">
	  					<h4><i class="icon fa fa-warning"></i>NO DEPARTMENT AVAILABLE</h4>
	 				</div>	
					@endif						
				</div>
				{{$department->render()}}					
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
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
