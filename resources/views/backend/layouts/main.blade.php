<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" href="{{asset('public/images/default-user.png')}}" />
    <meta charset="UTF-8">
    <title>HRM</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('public/sms/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />       
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="{{asset('public/sms/assets/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="{{asset('public/sms/assets/css/main.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/sms/assets/css/skins/skin-blue.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/sms/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />

    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{asset('public/sms/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('public/sms/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    
    <script src="{{asset('public/sms/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>    
    
    <!-- Morris.js charts -->
    @yield('custom-css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue fixed  sidebar-mini">
    <div class="wrapper">
      
      @include('backend.layouts.header')
      <!-- Left side column. contains the logo and sidebar -->
      
      @include('backend.layouts.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
         
          <!-- Left side column. contains the logo and sidebar -->
          @yield('tabs-header')
          
        @if(Session::has('error-msg'))
        <div class = "box-body">            
          <div class = "alert alert-danger alert-dissmissable">
            <button type = "button" class = "close" data-dismiss = "alert">X</button>
                <input type = "hidden" class = "global-remove-url" value = "{{URL::route('remove-global', array('error-msg'))}}">
                {{ Session::get('error-msg') }}
            </div>            
        </div>
        @endif
        @if(Session::has('success-msg'))
        <div class = "box-body">           
            <div class = "alert alert-success alert-dissmissable">
                <button type = "button" class = "close" data-dismiss = "alert">X</button>
                <input type = "hidden" class = "global-remove-url" value = "{{URL::route('remove-global', array('success-msg'))}}">
                {{ Session::get('success-msg') }}
            </div>            
        </div>
        @endif
        @if(Session::has('warning-msg'))
        <div class = "box-body">           
            <div class = "alert alert-info alert-dissmissable">
                <button type = "button" class = "close" data-dismiss = "alert">X</button>
                <input type = "hidden" class = "global-remove-url" value = "{{URL::route('remove-global', array('info-msg'))}}">
                {{ Session::get('warning-msg') }}
            </div>           
        </div>
         @endif
        @yield('page-header')
        </section>
        <section class="content">
          <div class="box">
            <div class="box-body">
              @yield('content')
            </div>
          </div>
        </section>
        <input type = "hidden" id = "current_url" value = "{{URL::current()}}">
      </div><!-- /.content-wrapper -->
     
    @include('backend.layouts.footer')
    </div><!-- ./wrapper -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js" type="text/javascript"></script> 
    <script src="{{asset('public/sms/assets/js/app.min.js')}}" type="text/javascript"></script>    
    
    <script>
      setTimeout(function() {
        $('.alert-success').fadeOut('slow');
        }, 2000);
    </script>
    
    <script type="text/javascript">
      $(document).ready(function()
    {
      $('.close').click(function(){
        //alert('here');
        var url = $(this).parent().find('.global-remove-url').val();
        
        var request = $.ajax
                ({
                  type: 'POST',
                  url: url
                });

      });
    });
    </script>
    
    
    <script type="text/javascript">
      $(function()
      {
        $('.treeview').each(function() {
          var links = $(this).find('a');
              console.log(links);
          links.each(function()
          {
            if ($(this).attr('href') == window.location.href.split('?')[0]) {
              console.log($(this).attr('href'));
              console.log(window.location.href.split('?')[0]);
              $(this).parent('.treeview-item').addClass('active');
              $(this).parent('.treeview-item').parent('.treeview-menu').parent('.treeview').addClass('active');
              $(this).parent('.treeview').addClass('active');

              $(this).parent('.treeview-item').parent('.treeview-menu').parent('.treeview').parent('.treeview-menu').parent('.treeview').addClass('active');
              $(this).parent('.treeview-item').addClass('active');
            } 
          });
          
        });

      });

    </script>

    @yield('custom-js')
    
  </body>
</html>