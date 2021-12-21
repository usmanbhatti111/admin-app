@extends('layouts.theme')
@section('script')
@endsection
@section('style')
@endsection
@section('content')
<div class="page-content">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card"> 
    
                    <div class="card-body">
                       
             @include('alertsInfo')
                        <h6 class="text-center">
                            Welcome to Dashboard
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection