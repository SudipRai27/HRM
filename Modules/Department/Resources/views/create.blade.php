@extends('backend.layouts.main')
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Add Department</b></h4>
	<a href="{{route('list-department')}}" type="button" class="btn btn-danger">Go Back</a><br><br>
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
				<form action="{{route('create-department-post')}}" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
						<b>Department Name:</b> <input type="text" name="department_name" class="form-control" value="{{ Input::old('department_name')}}" placeholder="Department Name">
						<br>
						<div class="form-group">
						<b>Description:</b> <textarea type="text" name="description" class="form-control" placeholder="Description" rows="6">{{ Input::old('description')}}</textarea>
						<br>
						<input type="submit" value="Create" class="btn btn-success">
					</div>
				{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection