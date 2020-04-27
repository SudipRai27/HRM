@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/sms/datepicker/css/datepicker.min.css')}}">
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Attendance Manager</b></h4>		
	@include('attendance::tabs')
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
          		<?php
          			$controller = new App\Http\Controllers\HelperController;
          			$user_type = $controller->checkUserType();

          		?>			          		
          		<input type="hidden" name="" id="user_type" value="{{$user_type}}">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-3">
							<input type="text" placeholder="Select Start Date" id="start" class="form-control" name="start_date" 
							value="">
							<div id="start_date_error_msg" style="color:red;">Please Select Start Date</div>
						</div>
						<div class="col-sm-3">
							<input type="text" placeholder="Select End Date" id="end" class="form-control" name="end_date"
							value="">
							<div id="end_date_error_msg" style="color:red;">Please Select End Date</div>
						</div>
						@if($user_type == 'superadmin')
						<div class="col-sm-3">
							<select class="form-control" id="user_id" name="user_id">
								<option value="">Select</option>
								@foreach($user as $index => $d)
								<option value="{{$d->id}}">{{$d->name}}</option>
								@endforeach
							</select>
							<div id="user_error_msg" style="color:red;">Please Select Users</div>
						</div>
						@else
						<?php 
							$user_id = $controller->getCurrentUserId();
						?>
						<input type="hidden" name="" id="user_id" value="{{$user_id}}">
						@endif
						<div class="col-sm-3">
							<input type="submit" name="" value="Go" class="btn btn-success" id="submit">
						</div>
					</div>					
				</div>		
				<div id="attendance-results">
				</div>				
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
{{-- <script type="text/javascript">
	$(document).ready(function(){

		$('#user_id').change(function() {
			var start_date = $('#start').val();
			var end_date = $('#end').val();
			var user_id = $('#user_id').val();

			if(start_date != 0 && end_date != 0 && user_id != 0)
			{
				var current_url = $('#current_url').val();
				
				current_url += '?start_date=' + start_date + '&end_date=' + end_date + '&user_id=' + user_id;
				window.location.replace(current_url);
			}
		});
	})
</script> --}}
<script type="text/javascript">
	$(document).ready(function(){
		$('#start_date_error_msg').hide();
		$('#end_date_error_msg').hide();
		$('#user_error_msg').hide();
		$('#submit').click(function(e){
			e.preventDefault();
			var start_date = $('#start').val();
			var end_date = $('#end').val();
			var user_id = $('#user_id').val();
			if(start_date == '')
			{
				//alert('Please Select Start Date');
				$("#start").css("border-color", "red");
				$('#start_date_error_msg').show();
				return false;
			}
			else
			{
				$("#start").css("border-color", "green");
				$('#start_date_error_msg').hide();
			}

			if(end_date == '')
			{
				//alert('Please Select End Date');
				$("#end").css("border-color", "red");
				$('#end_date_error_msg').show();
				return false;
			}
			else
			{
				$("#end").css("border-color", "green");
				$('#end_date_error_msg').hide();
			}

			if($('#user_type').val() == 'superadmin')
			{
				if(user_id == '')
				{
					//alert('Please Select Users');
					$("#user_id").css("border-color", "red");
					$('#user_error_msg').show();
					return false;
				}
				else
				{
					$("#user_id").css("border-color", "green");
					$('#user_error_msg').hide();
				}
			}		
			
			submitFormParameters(start_date, end_date, user_id);
		});


		function submitFormParameters(start_date, end_date, user_id)
		{			
			$('#attendance-results').html('<p align="center"><img src = {{asset('public/images/giphy.gif')}}></p>')
			$.ajax({
				'method' : 'GET', 
				'data' : {
					'start_date' : start_date, 
					'end_date' : end_date, 
					'user_id' : user_id
				}, 
				'url' : '{{route('ajax-get-attendance-history-from-date-and-user-id')}}'

			}).done(function(data){
				$('#attendance-results').html(data);
			});

		}

	});
</script>
@endsection



