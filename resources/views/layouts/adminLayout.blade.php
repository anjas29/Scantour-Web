<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Scantour</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('/admin/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/admin/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('/admin/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
  <link rel="shortcut icon" href="/images/scantour_logo.png" type="image/x-icon" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('header')
</head>
<body class="hold-transition skin-yellow sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="/administrator" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><img src="/images/scantour_logo.png" class="img img-responsive" style="padding:10px;"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Scantour</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/images/default.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/images/default.jpg" class="img-circle" alt="User Image"/>
                
                <p>
                  {{Auth::user()->name}}
                  <small>Admin</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/administrator/profil" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="/logout" class="btn btn-default btn-flat">Log Out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/images/default.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}
          <br><strong>Admin</strong></p>
          
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU NAVIGATION</li>
        <li>
          <a href="/administrator/index">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li>
          <a href="/administrator/news">
            <i class="fa fa-feed"></i> <span>News</span>
          </a>
        </li>
        <li>
          <a href="/administrator/promotions">
            <i class="fa fa-tag"></i> <span>Promotions</span>
          </a>
        </li>
        <li>
          <a href="/administrator/tours">
            <i class="fa fa-map"></i> <span>Tours</span>
          </a>
        </li>
        <li>
          <a href="/administrator/video">
            <i class="fa fa-video-camera"></i> <span>Video</span>
          </a>
        </li>
        <li class="header">MANAGEMENT USERS</li>
        <li>
          <a href="/administrator/users">
            <i class="fa fa-users"></i> <span>Users</span>
          </a>
        </li>
        <li>
          <a href="/administrator/admin">
            <i class="fa fa-user-secret"></i> <span>Administrator</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
  <script src="{{ asset('/admin/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{ asset('/admin/bootstrap/js/bootstrap.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('/admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('/admin/dist/js/app.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('/admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap -->
  <script src="{{ asset('/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="{{ asset('/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- ChartJS 1.0.1 -->
  <!--
  <script src="{{ asset('/admin/plugins/chartjs/Chart.min.js') }}"></script>
   AdminLTE dashboard demo (This is only for demo purposes) -->
  <!--<script src="{{ asset('/admin/dist/js/pages/dashboard2.js') }}"></script>-->
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('/admin/dist/js/demo.js') }}"></script>

  <script src="{{ asset('/js/toastr.min.js') }}"></script>
  <script src="{{ asset('/js/bootbox.min.js') }}"></script>
  <script src="{{ asset('/js/validator.js') }}"></script>
  <script>
  $(document).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    @if(Session::has('message'))
      toastr.success("{{ Session::get('message') }}");
    @elseif(Session::has('messageError'))
      toastr.error("{{ Session::get('messageError') }}");
    @endif
  });
  </script>
  @yield('js')
</body>
</html>
