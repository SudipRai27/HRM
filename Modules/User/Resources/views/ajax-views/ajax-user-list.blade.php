<table class="table table-bordered table-hover" id="search-results">        
<thead>
	<tr>
	<th>SN</th>
	<th>Name</th>
	<th>Email</th>
	<th>Address</th>
	<th>Role</th>
	<th>Contact</th>
	<th>Gender</th>
	<th>Photo</th>
	<th>Action</th>
	</tr>
</thead>
<?php  $i =1; ?>
@if(count($user))
<tbody>
@foreach($user as $index => $d)
	<tr>
	<td>{{$i++}}</td>
	<td>{{$d->name}}</td>
	<td>{{$d->email}}</td>
	<td>{{$d->address}}</td>
	<td>{{$d->role_name}}</td>
	<td>{{$d->contact}}</td>
	<td>{{$d->gender}}</td>
	<td>
		@if($d->photo)
		<img src="{{URL::to('public/images/user_photos/', $d->photo)}}" height="50px" width="60px">
		@else
		No photo
		@endif
	</td>	
	<td>
		<a href = "{{route('user-view', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-warning btn-flat" type="button" data-original-title="View User"> <i class="fa fa-fw fa-file"></i></button></a>
		<a href = "{{route('user-edit', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-success btn-flat" type="button" data-original-title="Edit"> <i class="fa fa-fw fa-edit"></i></button></a>
        <a href = "{{route('user-delete', $d->id)}}" onclick="return ConfirmDelete();"><button data-toggle="tooltip" title="" class="btn btn-danger btn-flat" type="button" data-original-title="Delete"> <i class="fa fa-fw fa-trash"></i></button></a>
	</td>
	</tr>
@endforeach
</tbody>       								
@else
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><p style = "color:red;">No Users Available</p></td>
</tr>
@endif
</table>