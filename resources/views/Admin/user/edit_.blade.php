@extends('layouts.theme')
@section('title','Edit User')
@section('style')
    <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid user-registrition">
            <div class="  w-100">
                <div class="card-body user-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <h5 class="card-title">Edit User</h5>

                                            @include('alertsInfo')
                                            <form class="custom-validation"  method="post" action="{{url('user/'.encrypt($user->id)) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label class="control-label">User Name</label>
                                                            <input class="form-control" required placeholder="Name" name="name" type="text" value="{{empty(old('name')) ? $user->name :old('name')}}">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback"  style="display: block">{{ $errors->first('name') }}</div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label class="control-label">User Type</label>
                                                            <input class="form-control" required placeholder="User type" name="user_type" type="text" value="{{empty(old('user_type')) ? $user->user_type :old('user_type')}}">
                                                            @if ($errors->has('user_type'))
                                                                <div class="invalid-feedback"  style="display: block">{{ $errors->first('user_type') }}</div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label class="control-label">E-Mail Address(optional)</label>
                                                            <input class="form-control" parsley-type="email"  placeholder="Email" name="email" type="text" value="{{empty(old('email')) ? $user->email :old('email')}}">
                                                            @if ($errors->has('email'))
                                                                <div class="invalid-feedback"  style="display: block">{{ $errors->first('email') }}</div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label class="control-label">Select Role</label>
                                                            <select data-placeholder="Select Role" required  id="roles" name ="roles" class="form-control select2"  >
                                                                <option value="">Select Role</option>
                                                                @foreach ($roles as $role)
                                                                    {{-- @if ($role->id = 1) --}}
                                                                        <option    value="{{$role->id}}" @foreach ($user->roles as $item)
                                                                            {{$role->id == $item->id?'selected ':''}}
                                                                                @endforeach >{{$role->name}}</option>
                                                                    {{-- @endif --}}
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group text-right ">
                                                            <a href="{{url('user')}}" class="btn btn-danger">Cancel</a>
                                                                <button type="submit" class="btn
                                                            btn-light waves-effect waves-light">
                                                                    Save
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div> <!-- end col -->


                            </div> <!-- end row -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url("libs/parsleyjs/parsley.min.js")}}"></script>
    <script src="{{url('libs/select2/js/select2.min.js')}}"></script>
    <script src="{{url('js/pages/form-validation.init.js')}}"></script>
    <script>
        $(".select2").select2({
            minimumResultsForSearch: -1,
            placeholder: function(){
                $(this).data('placeholder');
            }
        });
    </script>
@endsection
