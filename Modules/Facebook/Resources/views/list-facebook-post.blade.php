@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/lity.min.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Facebook Post Manager</b></h4>					
	
	<select class="form-control" id="post_type">
		<option value="none">Select Post Type</option>
		<option value="fb_post_link" @if($post_type == 'fb_post_link') selected @endif>Posts with Link</option>
		<option value="fb_post_image"@if($post_type == 'fb_post_image') selected @endif>Posts with Image</option>
	</select>
	<br>
		<div class="box"> 
			<div class="box-body">				
				<div class="table-responsive">
					<?php
						$i = 1;
					?>
					@if($post_type == 'fb_post_link')
					
						@if(count($fb_posts))									
				        <table class="table table-bordered table-hover">        
							<thead>
								<tr style="background-color:#333; color:white;">
								<th>SN</th>
								<th>Content</th>
								<th>Link</th>	
								<th>Created By</th>	
								<th>Created On</th>						
								<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($fb_posts as $index => $data)
								<tr>
								<td>{{$i++}}</td>
								<td>{{substr($data->message,0,50)}} {{strlen($data->message) > 50 ? '...' : ''}}</td>
								<td><a href="{{$data->link}}" target="_blank">{{$data->link}}</a></td>
								<td style="color:green;">{{$data->created_by}}</td>
								<td>{{date('Y M d D', strtotime($data->created_at))}}</td>
								<td>
									<a href = "{{route('view-facebook-post', ['id' => $data->id, 'post_type' => $post_type])}}" data-lity><button data-toggle="tooltip" title="" class="btn btn-warning btn-flat" type="button" data-original-title="View"> <i class="fa fa-fw fa-file"></i></button>													
			                        <a href = "{{route('delete-facebook-post', ['id' => $data->id, 'post_type' => $post_type])}}" onclick="return ConfirmDelete();"><button data-toggle="tooltip" title="" class="btn btn-danger btn-flat" type="button" data-original-title="Delete"> <i class="fa fa-fw fa-trash"></i></button>
								</td>
								</tr>
								@endforeach
							</tbody>    
				        </table>
				        {{ $fb_posts->appends(['post_type' => $post_type ])->links() }}
						@else
						<div class="alert alert-danger alert-dismissable">
		  					<h4><i class="icon fa fa-warning"></i>NO POSTS AVAILABLE</h4>
		 				</div>
						@endif

					@elseif($post_type == 'fb_post_image')
						@if(count($fb_posts))
									
				        <table class="table table-bordered table-hover">        
							<thead>
								<tr style="background-color:#333; color:white;">
								<th>SN</th>
								<th>Content</th>
								<th>Image</th>
								<th>Created By</th>		
								<th>Created On</th>						
								<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($fb_posts as $index => $data)
								<tr>
								<td>{{$i++}}</td>
								<td>{{substr($data->message,0,50)}} {{strlen($data->message) > 50 ? '...' : ''}}</td>
								<td><img src="{{URL::to('public/images/fb_post_images', $data->image)}}" height="60px" width="'60px"></td>
								<td style="color:green;">{{$data->created_by}}</td>
								<td>{{date('Y M d D', strtotime($data->created_at))}}</td>
								<td>
									<a href = "{{route('view-facebook-post', ['id' => $data->id, 'post_type' => $post_type])}}" data-lity><button data-toggle="tooltip" title="" class="btn btn-warning btn-flat" type="button" data-original-title="View"> <i class="fa fa-fw fa-file"></i></button>													
			                        <a href = "{{route('delete-facebook-post', ['id' => $data->id, 'post_type' => $post_type])}}" onclick="return ConfirmDelete();"><button data-toggle="tooltip" title="" class="btn btn-danger btn-flat" type="button" data-original-title="Delete"> <i class="fa fa-fw fa-trash"></i></button>
								</td>
								</tr>
								@endforeach
							</tbody>       								
				        </table>
				        {{ $fb_posts->appends(['post_type' => $post_type ])->links() }}
						@else
						<div class="alert alert-danger alert-dismissable">
		  					<h4><i class="icon fa fa-warning"></i>NO POSTS AVAILABLE</h4>
		 				</div>
						@endif						
					@else
						<div class="alert alert-warning alert-dismissable">
		  					<h4><i class="icon fa fa-warning"></i>PLEASE SELECT POST TYPE</h4>
		 				</div>
					@endif												
				</div>								
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript" src="{{asset('public/sms/assets/js/lity.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#post_type').change(function() {
			var post_type = $('#post_type').val();
			var page = $('#current_page').val();
			if(post_type != '')
			{
				var current_url = $('#current_url').val();
				current_url += '?post_type='+post_type;
				window.location.replace(current_url);
			}
		})
	});
</script>
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
