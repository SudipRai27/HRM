@extends('backend.layouts.main')
@section('content')
<style type="text/css">
	.btn-responsive {
    white-space: normal !important;
    word-wrap: break-word;
}
</style>
<div class="container">
 <div class="well col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
        <div class="row user-row">
            <div class="col-xs-3 col-sm-2 col-md-1 col-lg-1">
                <img class="img-circle"
                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50"
                     alt="User Pic">
            </div>
            <div class="col-xs-8 col-sm-9 col-md-10 col-lg-10">
                <strong>{{$superadmin->name}}</strong><br>
                
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 dropdown-user" data-for=".cyruxx">
                
            </div>
        </div>
        <div class="row user-infos cyruxx">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Superadmin information</h3>
                    </div>
                    <div class="panel-body table-responsive">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 ">
                                @if($superadmin->photo)
                                <img class="img-circle "
                                     src="{{URL::to('public/images/superadmin_photos', $superadmin->photo)}}"
                                     alt="User Pic" height="100px" width="100px">
                                @endif
                            </div>
                            
                            <div class=" col-md-9 col-lg-9 ">
                                <strong></strong><br>
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>User level:</td>
                                        <td>Superadmin</td>
                                    </tr>
                                    <tr>
                                        <td>Registered since:</td>
                                        <td>{{date('Y M d D', strtotime($superadmin->created_at))}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$superadmin->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact</td>
                                        <td>{{$superadmin->contact}}</td>
                                    </tr>
                                    <tr>
                                        <td>Temporary Address</td>
                                        <td>{{$superadmin->temporary_address}}</td>
                                    </tr>
                                    <tr>
                                        <td>Permanent Address</td>
                                        <td>{{$superadmin->permanent_address}}</td>
                                    </tr>

                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                       <div class="container">
						  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Change Password</button>

						  <!-- Modal -->
						  <div class="modal fade" id="myModal" role="dialog">
						    <div class="modal-dialog modal-lg">
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Change Password</h4>
						        </div>
						        <div class="modal-body" >
						          <form method="POST" id="change-password-form" action="{{route('change-password-superadmin')}}">
						          <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password"><br>
						          <input type="password" name="new_password" id = "new_password" class="form-control" placeholder="New Password"><br>
						          <input type="hidden" name="current_superadmin_id" id = "current_superadmin_id" value="{{$superadmin->id}}">
						          <input type="submit" name="Change Password" id="change-password" class="btn btn-success btn-responsive">
						          {{csrf_field()}}
						          </form>
						          

						        </div>
						        <div class="modal-footer">
						          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>                                  
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript">
	$(document).ready(function() {
		$('#change-password').on('click', function(e){
			e.preventDefault();
			var current_password = $('#current_password').val();
			var new_password = $('#new_password').val();
			

			if(current_password == '')
			{
				alert('Please Enter Current Password'); 
				$('#current_password').css({'border-color': 'red'}); 
				return false;
			}
			else
			{
				$('#current_password').css({'border-color': 'green'}); 
			}

			if(new_password == '')
			{
				alert('Please Enter New Password'); 
				$('#new_password').css({'border-color': 'red'}); 
				return false;
			}
			else
			{
				$('#new_password').css({'border-color': 'green'}); 
			}

			
			$('#change-password-form').submit();		
		});


	});
</script>
@stop
