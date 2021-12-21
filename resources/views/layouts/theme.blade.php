<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>  @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="POS" name="Common" />
    <meta content="Salahuddin" name="author" />
    <!-- App favicon -->
    {{--<link rel="shortcut icon" href="{{url('admin_template/images/favicon.png')}}">--}}
@yield('style')
    <!-- Bootstrap Css -->
    <link href="{{url('admin_template/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{url('admin_template/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{url('admin_template/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{url('admin_template/css/style.css')}}"   rel="stylesheet" type="text/css" />

    <script>var base_url = '{{url('/')}}';</script>
    <link href="{{url('admin_template/libs/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{url('admin_template/libs/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ url('admin_template/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{url('admin_template/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"></link>
    <style>
        .alert {
       width: 400px;
       height: 200px; 
    overflow: auto;
}
    </style>
    
</head>

<body data-topbar="dark">

<!-- Begin page -->
<div id="layout-wrapper">
     
        @include('Admin.header.header')
        @include('Admin.sidebar.sidebar')
      
    <!-- ============================================================== -->
    <!-- Start  Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
       @yield('content')
       @include('Admin.footer.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script src="{{url('admin_template/libs/jquery/jquery.min.js')}}"></script>
<script src="{{url('admin_template/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('admin_template/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{url('admin_template/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{url('admin_template/libs/node-waves/waves.min.js')}}"></script>
<script src="{{url('admin_template/libs/parsleyjs/parsley.min.js')}}"></script>
<script src="{{url('admin_template/libs/select2/js/select2.min.js')}}"></script>


<script src="{{url('admin_template/js/profile.js')}}"></script>
<script src="{{url('admin_template/js/app.js')}}"></script>
<script src="{{url('admin_template/libs/parsleyjs/parsley.min.js')}}"></script>
<script src="{{url('admin_template/js/pages/form-validation.init.js')}}"></script>
<script src="{{ url('admin_template/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{url('admin_template/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

@yield('script')
 <script>
     function sendMarkRequest(id = null) {
        $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                    type:'POST',
                 url: "{{url('mark-as-read')}}",
                 data: {
                 id
                  }
                                    
         });
    };
     $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').css('background', 'green');

            });
        });
        // $('#mark-all').click(function() {
        //     let request = sendMarkRequest();
        //     request.done(() => {
        //         $('div.alert').remove();
        //     })
        // });
    });
    // $(".select2").select2();
    // $( ".date" ).datepicker({
    //     format: "dd/mm/yyyy",
    //     autoclose: true  
    // }).datepicker("setDate", new Date());
    // $( ".edit-date" ).datepicker({
    //     format: "dd/mm/yyyy",
    //     autoclose: true  
    // });
    // $("#change_password").on('click', function(e){
    //     e.preventDefault();
    //     $("#success_msg").text("");
    //     $("#error_current_password").text("");
    //     $("#error_new_password").text("");
    //     $("#error_password_confirmation").text("");
    //     var form = $('#change_password_form').serialize();
    //     $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }, 
    //             type:'POST',
    //             url: '',
    //             data: form,
    //             success:function(response){ 
    //                 if(response.status){
    //                     $("#success_msg").removeClass("text-danger").addClass("text-success");
    //                     window.setTimeout(function(){location.reload()},1000)
    //                 }else{
    //                     $("#success_msg").addClass("text-danger").removeClass("text-success");
    //                 }
    //                  $("#success_msg").text(response.msg);
    //                 $("#error_current_password").text("");
    //                 $("#error_new_password").text("");
    //                 $("#error_password_confirmation").text("");
                    
    //             }, 
    //             error: function(res){
    //               $.each(res.responseJSON.errors, function (key, item) {
    //                    $("#error_"+key).text(item[0]  );
    //               });
    //             }
    //         })
    // })
</script> 
</body>

</html>


