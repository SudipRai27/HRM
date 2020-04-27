 @extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;Modules</b></h4>	

		<div class="box"> 
			<div class="box-body">
				<div class = 'content'>
				
					<div class="table-responsive">

						<table class = 'table table-striped table-hover table-bordered'>

						<tbody class = 'search-table'>
						@if(count($modules))
						<?php $i = 1; ?>

						@foreach($modules as $d)
						<tr>
						<td>{{$i++}}</td>
						<td><a href = "{{route('create-permission', $d)}}">{{$d}}</a></td>
						</tr>
						@endforeach
						@else
						<tr>
						<td>No Modules Found</td>
						</tr>
						@endif
						</tbody>

						</table>

					</div>

				</div>			
			</div>
		</div>
	</div>
</div>
@endsection

