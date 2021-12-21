@extends('layouts.theme')
@section('style')
<!-- DataTables -->
<link href="{{url('admin_template/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('admin_template/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{url('admin_template/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{url('admin_template/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
<style>
    .hide {
        display: none;
    }
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid customer-search">
        <div class="loading_div" id="loading" style="display: none">
            <div class="spinner-grow text-secondary  loading" role="status"></div>
        </div>

        <!-- start page title -->
        <div>
            <div class="card-body">
                @include('alertsInfo')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex">
                                    <div class="col-lg-6  ">

                                        <h5 class="card-title">User </h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="float-right d-print-none">
                                            @if(Auth::user()->hasRole('Admin'))
                                            @can('user.create')
                                            <a href="javascript:;" data-target="#create_modal" id="create_client_btn" data-toggle="modal" class="btn btn-primary float-right">Create User</a>
                                            @endcan
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered w-100 user_table">
                                        <thead>
                                            <tr>
                                                <th>ID. #</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                @if(Auth::user()->hasRole('Admin'))

                                                <th class="not-export-col">Action</th>
                                                @endif


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; ?>
                                            @foreach ($user as $value)
                                            <tr class="gradeX">
                                                <td class="count"> {{$count++}}</td>
                                                <td class="sender">{{$value->name}} </td>
                                                <td class="receiver">{{$value->email}} </td>
                                                <td>
                                                    @foreach ($value->roles as $role)
                                                    <span class="badge badge-boxed  badge-success"> {{ $role->name}} </span>
                                                    @endforeach
                                                </td>


                                                <td class="not-export-col">
                                                    <div class="btn-group ">
                                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        @if(Auth::user()->hasRole('Admin'))

                                                        <div class="dropdown-menu view-dropdown-menu ">

                                                            <a class="dropdown-item" href="{{url('user/'.encrypt($value->id).'/edit')}}"> <span class="mdi mdi-square-edit-outline edit-icon"> </span> Edit</a>

                                                            <a href="javascript:;" class=" delete dropdown-item action_imgs" data-id="{{encrypt($value->id)}}">
                                                                <span class=" mdi mdi-minus-circle minus-icon"></span> Delete
                                                            </a>

                                                        </div>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>


                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->



                <!-- /.create-dialog -->
                <div class="modal fade" id="create_modal" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Create New User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            </div>
                            <div class="modal-body">
                                <form class="custom-validation " id="create_form" action="javascript:;" method="post">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>Name</label>
                                                <input type="text" placeholder="Enter Name" autocomplete="off" id="name" name="name" class="form-control" value="{{old('name')}}" required autofocus>

                                                <span class="text-danger" id="err_create_sender"> </span>

                                            </div>

                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label>Email</label>
                                                <input type="email" placeholder="Enter Email" autocomplete="off" id="email" name="email" class="form-control" value="{{old('email')}}" required autofocus>

                                                <span class="text-danger" id="err_create_receiver"> </span>

                                            </div>

                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label>Password</label>
                                                <input type="text" placeholder="Enter Password" autocomplete="off" id="password" name="password" class="form-control" value="{{old('password')}}" required autofocus>

                                                <span class="text-danger" id="err_create_receiver"> </span>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-light float-right submit_create_form  waves-light">Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>

                </div>

                <div class="modal fade" id="edit_modal" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            </div>


                            <div class="modal-body">
                                <form class="custom-validation " id="edit_form" action="javascript:;" method="post">
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>name</label>
                                                <input type="text" placeholder="Enter Name" autocomplete="off" id="edit_name" name="name" class="form-control" value="{{old('name')}}" required autofocus>

                                                <span class="text-danger" id="err_edit_name"> </span>

                                            </div>


                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label>email</label>
                                                <input type="text" placeholder="Enter Email" autocomplete="off" id="edit_email" name="email" class="form-control" value="{{old('email')}}" required autofocus>

                                                <span class="text-danger" id="err_edit_email"> </span>

                                            </div>


                                            <div class="form-group ">
                                                <label>Select Role</label>
                                                <select data-placeholder="Select Role" required id="edit_roles" name="roles" class="form-control select2">
                                                    <option value=""></option>



                                                </select>
                                            </div>



                                            <div class="col-md-12">
                                                <button class="btn btn-md btn-primary m-t-n-xs float-right submit_edit_form " type="submit">Save</button>
                                            </div>
                                        </div>
                                </form>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<!-- Required datatable js -->
<script src="{{url('admin_template/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin_template/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{url('admin_template/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('admin_template/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('admin_template/libs/jszip/jszip.min.js')}}"></script>
<script src="{{url('admin_template/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{url('admin_template/libs/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{url('admin_template/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('admin_template/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('admin_template/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{url('admin_template/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('admin_template/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{url('admin_template/js/pages/datatables.init.js')}}"></script>

<script src="{{url('admin_template/libs/sweetalert2/sweetalert2.min.js')}}"></script>


<script>
    function updateSerial() {
        count = 0;
        $(".count").each(function() {
            count++;
            $(this).html(count);

        });
    }

    $(document).on('submit', '#create_form', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            data: formData,
            url: "{{url('user')}}",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#loading").show();
            },

        }).done(function(response) {
            $("#loading").hide();

            if (response.status) {
                table = $('#datatable-buttons').DataTable();
                swal.fire("Message", response.msg, "success");
                $('#create_modal').modal('toggle');

                setTimeout(function() {
                    location.reload();
                }, 500);

            }

        }).fail(function(error) {
            $("#err_create_name").text("");
            $("#loading").hide();
            $.each(error.responseJSON.errors, function(key, item) {
                $("#err_create_" + key).text(item[0]);
            });
        });
    });

    $(document).on('submit', '#edit_form', function(e) {

        e.preventDefault();
        var formData = new FormData(this);
        var name = $("#edit_name").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            data: formData,
            url: "{{url('user/update')}}",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#loading").show();
            },

        }).done(function(response) {
            $("#loading").hide();

            if (response.status) {
                table = $('#datatable-buttons').DataTable();
                swal.fire("Message", response.msg, "success");
                $('#create_modal').modal('toggle');

                setTimeout(function() {
                    location.reload();
                }, 500);

            }

        }).fail(function(error) {
            $("#err_create_name").text("");
            $("#loading").hide();
            $.each(error.responseJSON.errors, function(key, item) {
                $("#err_edit_" + key).text(item[0]);
            });
        });
    });


    $(document).on('click', '.edit_', function() {
        $("#error_name").text("");
        var id = $(this).data('id');
        editing_row = $(this).closest('tr');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'GET',
            url: "{{url('user')}}/" + id + "/edit",
            // url:"{{url('user/{id}/edit')}}",
            beforeSend: function() {
                $("#loading").show();
            },
        }).done(function(response) {
            console.log(response);
            $("#loading").hide();
            $("#edit_id").val(response.user.id);


            $("#edit_name").val(response.user.name);
            $("#edit_email").val(response.user.email);



            $('#edit_modal').modal('toggle');

        }).fail(function(error) {
            $("#loading").hide();
            swal.fire("Cancelled", error.responseJSON.message, "error");
        });
    });


    $(document).on('click', '.delete', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    data: {
                        '_method': 'DELETE'
                    },
                    url: "{{url('user/')}}/" + uid,
                    beforeSend: function() {
                        $("#loading").show();
                    },
                }).done(function(response) {
                    $("#loading").hide();
                    Swal.fire("Deleted!", response.msg, "success");
                    var table = $('#datatable-buttons').DataTable();
                    table.row(tr).remove().draw();
                    updateSerial()

                }).fail(function(response) {
                    $("#loading").hide();
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
@endsection

@endsection