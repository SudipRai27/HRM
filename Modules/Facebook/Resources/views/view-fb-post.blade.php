@extends('backend.layouts.submain')
@section('content')
@if($post_type == 'fb_post_image')
	<div class="container" style="background-color:darkred; color:white; height:50px;" >
	<h4>FaceBook Post Details</h4>
	</div>
	<br>
	<div class="container">
	<textarea class="form-control" readonly rows="7">Content: {{$fb_post->message}}</textarea><br>
	<input type="text" name="" class="form-control" readonly value="Created By: {{$fb_post->created_by}}"><br>
	<input type="text" name="" class="form-control" readonly value="Created On: {{date('Y M d D', strtotime($fb_post->created_at))}}"><br>
	<p align="center"><img src="{{URL::to('public/images/fb_post_images', $fb_post->image)}}" height="200px" width="200px"></p>
	</div>
@endif

@if($post_type == 'fb_post_link')
	<div class="container" style="background-color:darkred; color:white; height:50px;" >
	<h4>FaceBook Post Details</h4>
	</div>
	<br>
	<div class="container">
	<textarea class="form-control" readonly rows="7">Content: {{$fb_post->message}}</textarea><br>
	<input type="text" name="" readonly value="Link: {{$fb_post->link}}" class="form-control"><br>
	<input type="text" name="" class="form-control" readonly value="Created By: {{$fb_post->created_by}}"><br>
	<input type="text" name="" class="form-control" readonly value="Created On: {{date('Y M d D', strtotime($fb_post->created_at))}}"><br>
	
	</div>
@endif
@endsection