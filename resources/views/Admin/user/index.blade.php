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
<div class="card-body">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><center>USER CRUD</center> </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('custom.create')}}"> Create New User</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
         @foreach ($users as $user)
         <tr>
            <td></td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form action="{{ route('user.destroy',$user->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr> 
         @endforeach 
    </table>
  
</div>     
@endsection