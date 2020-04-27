@extends('backend.layouts.main')

@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Facebook Posts Manager</b></h4>		
	@include('facebook::tabs')
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
          		<form action="{{route('create-fb-posts-with-link')}}" method="POST" enctype="multipart/form-data">
					<div class="box-body">												
						<div class="form-group">
							<b>Message:</b> 
							<textarea id="editor" type="text" name="message" class="form-control" placeholder="Enter Message To Post" rows="6">{{ Input::old('message')}}</textarea>
							<div id="msg" style="color:red;">{{ $errors->first('message') }}</div>
						</div>						
						<div class="form-group">
							<b>Link:</b>
							<input type="text" name="link" class="form-control" placeholder="Enter Link (Youtube Videos or any other Links)" value="{{Input::old('link')}}">
							<div id="msg" style="color:red;">{{ $errors->first('link') }}</div>
						</div>						
						<input type="submit" value="Post to Facebook" class="btn btn-success">
					</div>
				{{ csrf_field() }}
				</form>          	          						
			</div>
		</div>
	</div>
</div>
@endsection




