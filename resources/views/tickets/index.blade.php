@extends('layouts.theme')
@section('style')
<!-- DataTables -->
<link href="{{url('admin_template/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('admin_template/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{url('admin_template/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{url('admin_template/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">

@endsection
@section('title', 'All Tickets')
@section('content')
<div class="card-body mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-lg-6 ">

                            <h5 class=" btn-btn sucesss card-title">Tickets </h5>
                        </div>
                        <div class="col-lg-6">
                            <div class="float-right d-print-none">

                                <a href="{{url('new-ticket')}}" class="btn btn-primary float-right mt-4">Create Tickets</a>

                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered w-100 user_table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <th style="text-align:center" colspan="4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                    {{ $ticket->category->name }}
                                    </td>
                                    <td>
                                        <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                                            #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($ticket->status === 'Open')
                                            <span class="label label-success">{{ $ticket->status }}</span>
                                        @else
                                            <span class="label label-danger">{{ $ticket->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->updated_at }}</td>
                                    <td>
                                        @if($ticket->status === 'Open')
                                            <a href="{{ url('tickets/' . $ticket->ticket_id) }}" class="btn btn-primary">Comment</a>
                                            <form action="{{ url('close_ticket/' . $ticket->ticket_id) }}" method="POST">
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger">Close</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>




</div>



@endsection