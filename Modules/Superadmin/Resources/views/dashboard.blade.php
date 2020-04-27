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
    
      </section>
      
    </div><!-- row ends -->

  </section><!-- /.content -->
@endsection
@section('custom-js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js"></script>
@endsection       

