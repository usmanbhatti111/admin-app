@extends('layouts.theme')


@section('content')
<div class="card-body">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
                <button class="btn btn-primary " onclick="add_custom('add_class')"> Add Custom Fields</button>

            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div style="display:none;" id="add_class" class="form-group add_fields  ">
        <form name="add_name" id="add_name">


            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>


            <div class="alert alert-success print-success-msg" style="display:none">
                <ul></ul>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_field">
                    <tr>




                        <td> <input type="text" name="name[]" placeholder="Enter field Name" class="form-control name_list" /></td>
                        <td> <input type="text" name="name[]" placeholder="Enter your type" class="form-control name_list" /></td>
                        <td>
                            <input type="radio" id="age1" name="age" value="30">
                            <label for="age1">yes</label>
                            <input type="radio" id="age1" name="age" value="30">
                            <label for="age3">No</label><br><br>
                        </td>


                        <td><button type="button" name="add" id="add" class="btn btn-success add">Add More</button></td>

                    </tr>
                </table>
                <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
            </div>


        </form>
    </div>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>

</div>
@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script> 

<script>
    function add_custom(i) {
        document.getElementById(i).style.display = 'block';
    }
</script>
<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">

      <td>
        <input type="text" name="task_name[]" value="@{{ task_name }}">
      </td>
      <td>
        <input type="number" class="cost" name="cost[]" value="@{{ cost }}">
      </td>
  
      <td>
       <i class="removeaddmore" style="cursor:pointer;color:red;">Remove</i>
      </td>
    </tr>
 </script>


<script type="text/javascript">
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {

            var field_name = $("#field_name").val();
            var field_type = $("#field_type").val();
            var source = $("#document-template").html();
            var template = Handlebars.compile(source)
            //    i++;  
            //    $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter Field Name" class="form-control name_list" /></td><td><input type="text" name="name[]" placeholder="Enter Field Type" class="form-control name_list" /></td><td><input type="text" name="name[]" placeholder="Enter Field Type" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        });


        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#submit').click(function() {
            $.ajax({
                url: postURL,
                method: "POST",
                data: $('#add_name').serialize(),
                type: 'json',
                success: function(data) {
                    if (data.error) {
                        printErrorMsg(data.error);
                    } else {
                        i = 1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display', 'block');
                        $(".print-error-msg").css('display', 'none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }
            });
        });


        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $(".print-success-msg").css('display', 'none');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
</script>