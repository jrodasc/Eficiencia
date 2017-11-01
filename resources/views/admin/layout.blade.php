<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Control de Archivos | V 1.0</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/adminlte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/plugins/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="/adminlte/css/skins/skin-blue.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/css/custom-style.css">
  <!-- Data tables -->
  <link rel="stylesheet" href="/adminlte/bootstrap/css/dataTables.bootstrap.min.css">
  <!-- Skin iCheck -->
  <link href="/adminlte/plugins/iCheck/flat/blue.css" rel="stylesheet">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery -->
    <script src="/adminlte/plugins/jQuery/jquery-2.2.4.js"></script>
    <!-- ChartJS -->
    <script src="/adminlte/plugins/chartjs/Chart.js"></script>
    <script src="/js/libs/jquery/jquery-2.1.4.min.js"></script>
    <script src="/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/toastr/toastr.min.js"></script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Main Header -->
  @include('admin.header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('admin.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <h1>
        Bienvenido
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section> --}}
    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('admin.footer')

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 
<script src="/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
-->
<!-- iCheck -->
<script src="/adminlte/plugins/iCheck/icheck.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/adminlte/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/app.min.js"></script>
<!-- Script de métricas -->
{{-- <script src="/js/metricas.js"></script> --}}
<!-- Data Tables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables2.min.js"></script>
<!-- JS Bootstrap Datatables-->
<script src="/adminlte/plugins/datatables/dataTables2.bootstrap.min.js"></script>
<!--Input Mask-->
<script src="/adminlte/plugins/inputmask/jquery.inputmask.bundle.js"></script>
<!-- Scripts -->
<script src="/js/scripts.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
