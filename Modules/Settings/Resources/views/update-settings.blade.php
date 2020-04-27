@extends('backend.layouts.main')
@section('content')
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
@if(count($settings))

<b><h4>Update Settings</h4></b>
<form action="{{ route('settings-update') }}" method="POST" enctype="multipart/form-data">
 <div class="box-body">
   <div class="form-group">
	Company Name: <input type="text" name="company_name" class="form-control" value="{{$settings->company_name}}">
	<div id="msg" style="color:red;">{{ $errors->first('company_name') }}</div>
   </div>
   <div class="form-group">
	Address: <input type="text" name="address" class="form-control" value="{{$settings->address}}">
	<div id="msg" style="color:red;">{{ $errors->first('address') }}</div>
   </div>
   <div class="form-group">
	Telephone: <input type="text" name="telephone" class="form-control" value="{{$settings->telephone}}">
	<div id="msg" style="color:red;">{{ $errors->first('telephone') }}</div>
   </div>
 	Logo:
	<input type="file" name="logo" class="form-control">
	<div id="msg" style="color:red;">{{ $errors->first('logo') }}</div>	
	@if($settings->logo)
	<br>
	Current Photo:<br>
	<img src="{{ URL::to('public/images/settings/'.$settings->logo)}}" width="150" height="100" class="img-responsive">
	@endif
   <div class="box-footer">
	<input type="submit" name="Submit" value="Update" class="btn btn-primary">
	<input type="hidden" name="settings_id" value="{{$settings->id}}">
   </div>
	{{ csrf_field() }}
</form>

@else

<b><h4>Update Settings</h4></b>
<form action="{{ route('settings-update') }}" method="POST" enctype="multipart/form-data">
 <div class="box-body">
   <div class="form-group">
	Company Name: <input type="text" name="company_name" class="form-control">
	<div id="msg" style="color:red;">{{ $errors->first('company_name') }}</div>
   </div>
   <div class="form-group">
	Address: <input type="text" name="address" class="form-control">
	<div id="msg" style="color:red;">{{ $errors->first('address') }}</div>
   </div>
   <div class="form-group">
	Telephone: <input type="text" name="telephone" class="form-control">
	<div id="msg" style="color:red;">{{ $errors->first('telephone') }}</div>
   </div>
 	Logo:
	<input type="file" name="logo" class="form-control">
	<div id="msg" style="color:red;">{{ $errors->first('logo') }}</div>	
   <div class="box-footer">
	<input type="submit" name="Submit" value="Update" class="btn btn-primary">
   </div>
	{{ csrf_field() }}
</form>
@endif

@endsection