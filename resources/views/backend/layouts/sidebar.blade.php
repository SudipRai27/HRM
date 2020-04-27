<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
           <?php
                 $url = URL('/');                
                 $auth_id = auth()->guard('superadmin')->id();
                 if($auth_id)
                 {
                    $current_user = DB::table('superadmin')->where('id', $auth_id)->first();
                    $image_path = 'superadmin_photos';
                    $dashboard_url = "superadmin/home";
                    $user_type = 'superadmin';

                 }
                 else
                 {
                    $auth_id = auth()->guard('user')->id();
                    $current_user = DB::table('users')->where('id', $auth_id)->first();
                    $image_path = 'user_photos';
                    $dashboard_url = "user/home";
                    $user_type = 'user';
                 }
            ?>

        @if($current_user->photo)
        <img src="{{ URL::to('public/images')}}/{{$image_path}}/{{$current_user->photo}}" class="img-circle" width="20" height="24">            
         @else
        <img src="{{ URL::to('public/images/default-user.png')}}" class="img-circle" width="20" height="20">     
        @endif
       
       </div>
      <div class="pull-left info">
        <p>{{ $current_user->name }}</p>


        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu scrollbar-dynamic">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview">
        <a href="{{$url}}/{{$dashboard_url}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Department Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-department')}}"><i class="fa fa-circle-o"></i>List Departments</a></li>
           
        </ul>
      </li> 
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Job Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-job')}}"><i class="fa fa-circle-o"></i>List Jobs</a></li>
           
        </ul>
      </li> 

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Users Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-user')}}"><i class="fa fa-circle-o"></i>List Users</a></li>
           <li class="treeview-item"><a href="{{route('user-register')}}"><i class="fa fa-circle-o"></i>Create users</a></li>
        </ul>
      </li> 

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Attendance Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-attendance')}}"><i class="fa fa-circle-o"></i>List Attendance</a></li>           
        </ul>
      </li> 

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Leave Request Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-leave')}}"><i class="fa fa-circle-o"></i>List Leave Request</a></li> 
          <li class="treeview-item"><a href="{{route('create-leave')}}"><i class="fa fa-circle-o"></i>Create Leave Request</a></li>           
        </ul>
      </li> 

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Daily Report Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-report')}}"><i class="fa fa-circle-o"></i>List Daily Report</a></li> 
          <li class="treeview-item"><a href="{{route('create-report')}}"><i class="fa fa-circle-o"></i>Create Daily Report</a></li>           
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Facebook Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-fb-post')}}"><i class="fa fa-circle-o"></i>List FB Post</a></li>           
          <li class="treeview-item"><a href="{{route('create-fb-posts')}}"><i class="fa fa-circle-o"></i>Create FB Post</a></li>           
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Chat Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('chat-view')}}"><i class="fa fa-circle-o"></i>Go To Chat App</a></li>
           
        </ul>
      </li> 

     {{-- <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Projects Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-project')}}"><i class="fa fa-circle-o"></i>List Projects</a></li>
           <li class="treeview-item"><a href="{{route('create-project')}}"><i class="fa fa-circle-o"></i>Create Projects</a></li>
        </ul>
      </li> 
      --}}

       <li class="treeview">
        <a href="{{URL::route('update-general-settings')}}">
          <i class="fa fa-dashboard"></i> <span>General Settings</span>
        </a>
      </li>
      
      @if($user_type == "superadmin")
        <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Permissions</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-modules')}}"><i class="fa fa-circle-o"></i>Modules/ Permission  Roles</a></li>

        </ul>
      </li>
      @endif
      

    </ul>

  </section>
  <!-- /.sidebar -->
</aside>