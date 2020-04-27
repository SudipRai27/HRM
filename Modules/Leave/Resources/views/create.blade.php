@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/sms/datepicker/css/datepicker.min.css')}}">
@endsection
@section('content')
<?php
	$controller = new App\Http\Controllers\HelperController;
	$user_type = $controller->checkUserType();
?>
<div class="row">
	<div class="col-xs-12">
	<h4><b>Add Leave Request</b></h4>
	<a href="{{route('list-leave')}}" type="button" class="btn btn-danger">Go Back</a><br><br>
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
				<form action="{{route('create-leave-post')}}" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						@if($user_type == 'superadmin')
						<div class="form-group">
							<b>User/Staff:</b>
							<select class="form-control" name="user_id">
							<option value="">Select</option>
							@foreach($user as $index => $value)
							<option value="{{$index}}" @if(Input::old('user_id') == $index) selected @endif>{{$value}}</option>
							@endforeach
							</select>
							<div id="msg" style="color:red;">{{ $errors->first('user_id') }}</div>
						</div>		
						@endif
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
								<b>Start Date:</b>
								<input type="text" placeholder="Select Start Date" id="start" class="form-control" name="start_date" 
								value="{{Input::old('start_date')}}">
								<div id="msg" style="color:red;">{{ $errors->first('start_date') }}</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<b>End Date:</b>
								<input type="text" placeholder="Select End Date" id="end" class="form-control" name="end_date"
								value="{{Input::old('end_date')}}">
								<div id="msg" style="color:red;">{{ $errors->first('end_date') }}</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<b>Reason / Description:</b> <textarea type="text" name="description" class="form-control" placeholder="Enter Reason or Description" rows="6">{{ Input::old('description')}}</textarea>
							<div id="msg" style="color:red;">{{ $errors->first('description') }}</div>
						</div>						
						<input type="submit" value="Create" class="btn btn-success">
					</div>
				{{ csrf_field() }}
				</form>
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
@endsection