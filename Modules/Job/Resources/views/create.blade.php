@extends('backend.layouts.main')
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Add Jobs</b></h4>
	<a href="{{route('list-job')}}" type="button" class="btn btn-danger">Go Back</a><br><br>
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
				<form action="{{route('create-job-post')}}" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
						<b>Job Title:</b> <input type="text" name="job_title" class="form-control" value="{{ Input::old('job_title')}}" placeholder="Job Title">
						</div>
						<div class="form-group">
						<b>Job Description:</b> <textarea type="text" name="job_description" class="form-control" placeholder="Job Description" rows="6">{{ Input::old('job_description')}}</textarea>
						</div>
						<div class="form-group">
						<b>Department:</b>
						<select class="form-control" name="department_id">
						@foreach($department_list as $index => $value)
						<option value="{{$index}}" @if(Input::old('department_id') == $index) selected @endif>{{$value}}</option>
						@endforeach
						</select>
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