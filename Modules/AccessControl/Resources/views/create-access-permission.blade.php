 @extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>&nbsp;&nbsp;&nbsp;Create Permissions</b></h4>	
		<a href="{{route('list-modules')}}" type="button" class="btn btn-danger">Go Back </a><br><br>
		<div class="box"> 
			<div class="box-body">
				<h5><b>Module Name: {{$module_name}}</b></h5>
				<form action = "{{route('create-permissions-post', $module_name)}}" method = "post">
				<div class = "row">
				<div class = "col-md-3"><b>Permission Type</b></div>
				<div class = "col-md-9"><b>Permission Groups</b></div>
				</div>
				<br>
				@foreach($access as $permission_type => $a)
				<div class = "row">
					<div class = "col-md-3">
					{{ $permission_type }}
					<input type="hidden" name="permission_type[]" value="{{$permission_type}}">
					</div>
					<div class = "col-md-9">
					<div class = "row">
					@foreach($roles as $role_id => $group_name)
					<span><input type = "checkbox" name ="{{$permission_type}}_[]"  value = "{{ $role_id}}"
					@if(in_array($role_id, $a)) checked @endif>{{$group_name}}</span>
					@endforeach				
					</div>
					</div>
				</div>
				<br>
				@endforeach
				<br>
				<input type = "submit" class = "btn btn-success" value = "Set Permission">

				{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

