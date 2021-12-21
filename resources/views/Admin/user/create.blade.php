<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="{{url('admin_template/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">

</head>

<body>
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <h2>
                <center>Add New User</center>
            </h2>

            <div class="pull-right">
                <a class="btn btn-primary float-left"  href="{{ route('user.index') }}"> Back</a>
                <button class="btn btn-primary " onclick="add_custom('add_class')"> Add Custom Fields</button>

            </div>
        </div>
    </div>
    <div class="container" id="add_class" style="display:none;">
        <div class="row">
            <div class="col-md-2">
                <label for="">Field Name</label>
                <input type="text" placeholder="Enter Field name" class="form-control form-control-sm" name="task_name" id="task_name" value="">
                <font style="color:red">  </font>
            </div>
            <div class="col-md-2">
                <label for="">Field Type</label>
                <input type="text" placeholder="Enter Field Type" class="form-control form-control-sm" name="cost" id="cost" value="">
                <font style="color:red">  </font>
            </div>
            <div class="col-md-2" style="margin-top:26px;">
                <button id="addMore" class="btn btn-success btn-sm">Add More </button>
            </div>
        </div>
        <div class="row" style="margin-top:26px;">
            <div class="col-md-5">


                <form class="custom-validation" id="create_form" action="javascript:;" method="post">
                    @csrf

                    <table class="table table-sm table-bordered" style="display: none;">
                        <thead>
                            <tr>
                                <th>Field Name</th>
                                <th>Field Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="addRow" class="addRow">

                        </tbody>
                        <tbody>

                        </tbody>

                    </table>
                    <button type="submit" class="btn btn-success btn-sm float-right submit_create_form">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{ route('custom.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-10">
                @foreach ($users as $user => $name)
                <div class="form-group">

                    <input type="text" class="form-control" value="{{ $name }}" />
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>



        </form>

        <script src="//code.jquery.com/jquery.js"></script>
        <script src="{{url('admin_template/libs/sweetalert2/sweetalert2.min.js')}}"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
        <script>
            function add_custom(i) {
                document.getElementById(i).style.display = 'block';
            }
        </script>
        <script id="document-template" type="text/x-handlebars-template">
            <tr class="delete_add_more_item" id="delete_add_more_item">

      <td>
        <input type="text" name="field_name[]" value="@{{ field_name }}">
      </td>
      <td>
        <input type="text" class="cost" name="field_type[]" value="@{{ field_type }}">
      </td>
  
      <td>
       <i class="removeaddmore" style="cursor:pointer;color:red;">Remove</i>
      </td>

  </tr>
 </script>

        <script type="text/javascript">
            $(document).on('click', '#addMore', function() {

                $('.table').show();

                var field_name = $("#field_name").val();
                var field_type = $("#field_type").val();
                var source = $("#document-template").html();
                var template = Handlebars.compile(source);

                var data = {
                    field_name: field_name,
                    field_type: field_type
                }

                var html = template(data);
                $("#addRow").append(html)

            });

            $(document).on('click', '.removeaddmore', function(event) {
                $(this).closest('.delete_add_more_item').remove();
            });
//on Submit Click

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
            url: "{{url('custom')}}",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#loading").show();
            },

        }).done(function(response) {
            $("#loading").hide();

            if (response.status) {
                $('#add_class').hide();
                swal.fire("Message", response.msg, "success");

                setTimeout(function() {
                    location.reload();
                }, 500);

            }

        }).fail(function(error) {
           
            $("#loading").hide();
            
        });
    });
        </script>

</body>

</html>