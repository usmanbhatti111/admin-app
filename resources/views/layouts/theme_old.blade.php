<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | theme</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('theme/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('theme/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('theme/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('theme/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    @include('Admin.Navbar.navbar')

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('Admin.sidebar.sidebar')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @yield('content')

      
     
    </div>
    
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.4
      </div>
    </footer>

    
  </div>

  @yield('script')

  <script src="{{asset('theme/plugins/jquery/jquery.min.js')}}"></script>
  
  <script src="{{asset('theme/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script>
    $("#change_password").on('click', function(e){
        e.preventDefault();
        $("#success_msg").text("");
         
        $("#error_current_password").text("");
        $("#error_new_password").text("");
        $("#error_password_confirmation").text("");
        var form = $('#change_password_form').serialize();
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                type:'POST',
                url: '',
                data: form,
                success:function(response){ 
                    if(response.status){
                        $("#success_msg").removeClass("text-danger").addClass("text-success");
                        window.setTimeout(function(){location.reload()},1000)
                    }else{
                        $("#success_msg").addClass("text-danger").removeClass("text-success");
                    }
                     $("#success_msg").text(response.msg);
                    $("#error_current_password").text("");
                    $("#error_new_password").text("");
                    $("#error_password_confirmation").text("");
                    
                }, 
                error: function(res){
                  $.each(res.responseJSON.errors, function (key, item) {
                     
                       $("#error_"+key).text(item[0]  );
                  });
                }
            })
    })
</script>
  <script src="{{asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('theme/plugins/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('theme/plugins/sparklines/sparkline.js')}}"></script>
  <script src="{{asset('theme/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('theme/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <script src="{{asset('theme/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <script src="{{asset('theme/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('theme/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script src="{{asset('theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <script src="{{asset('theme/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script src="{{asset('theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <script src="dist/js/adminlte.js"></script>
  <script src="{{asset('theme/dist/js/pages/theme.js')}}"></script>
  <script src="{{asset('theme/dist/js/demo.js')}}"></script>
</body>

</html>