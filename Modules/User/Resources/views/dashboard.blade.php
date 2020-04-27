@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.css">
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     My Dashboard  
    </h1>
    <br>
     <a href="{{ route('attendance-user-check-in')}}" type="button" class="btn btn-success " onclick="return confirmCheckIn();">Create Attendance / Check In</a>  
     <a href="{{ route('attendance-user-check-out')}}" type="button" class="btn btn-warning " onclick="return confirmCheckOut();">Attendance Check Out </a>  

     <p align="right" style="color:red;">
      <?php
        $today = Carbon\Carbon::now()->format('Y-m-d');
        $controller = new App\Http\Controllers\AttendanceHelperController;
        $check_leave = $controller->checkLeaveRequestForToday(auth()->guard('user')->id());
        $record = DB::table('attendance')
              ->where('user_id',auth()->guard('user')->id())
              ->where('attendance_date', $today)
              ->first();

      ?>      
      @if($check_leave == 'leave')
      You are on a leave today              
      @else        
        @if(count($record))
        Attendance /Checked In : {{$record->attendance_time}}
        @else
        You have not checked in today
        @endif
      @endif

      @if(count($record))
      @if($record->attendance_check_out_time)<br>
      Checked Out : {{$record->attendance_check_out_time}}
      @endif
      @endif
     </p>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3></h3>
            <p>Products</p>
          </div>
          <div class="icon">
            <i class="fa fa-product-hunt"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3></h3>
            <p>Category</p>
          </div>
          <div class="icon">
            <i class="fa fa-list-alt"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3></h3>
            <p>Sub Category</p>
          </div>
          <div class="icon">
            <i class="fa fa-list-ol"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3></h3>
            <p>Suppliers</p>
          </div>
          <div class="icon">
            <i class="fa fa-user-secret"></i>
          </div>
        </div>
      </div><!-- ./col -->
    </div><!-- /.row -->
    <hr size="2" style="border-color:#3c8dbc;">
    <div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3></h3>
            <p>Users</p>
          </div>
          <div class="icon">
           <i class="fa fa-users"></i>  
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3></h3>
            <p>Total Dues</p>
          </div>
          <div class="icon">
            <i class="fa fa-money" aria-hidden="true"></i>
          </div>
        </div>
      </div><!-- ./col -->

       <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3></h3>
            <p>Items Sold Today</p>
          </div>
          <div class="icon">
            <i class="fa fa-scribd" aria-hidden="true"></i>
          </div>
        </div>
      </div><!-- ./col -->

       <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3></h3>
            <p>Items Purchased Today</p>
          </div>
          <div class="icon">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </div>
        </div>
      </div><!-- ./col -->

    </div>
    
    
    </div><!-- row ends -->

  </section><!-- /.content -->
@endsection
@section('custom-js')
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js"></script>
<script>
function confirmCheckOut()
{
  var x = confirm("Are you sure to check out?");
  if (x)
      return true;
  else
      return false;
}

function confirmCheckIn()
{
  var x = confirm("Are you sure to check in?");
  if (x)
      return true;
  else
      return false;
}
</script> 
@endsection       

