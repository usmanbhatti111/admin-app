<div >
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-comments"></i>
      <span class="badge badge-danger navbar-badge">{{$count}}</span>
    </a>
    <div class="alert dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <a href="{{url('view_all')}}" class="btn btn-danger"> Check All </a> 

      @foreach ($notifications as $notify) 

      <a href="#" class="dropdown-item">
        <!-- Message Start -->
        <div class=" media">
          <div style="over-flow:auto;" class="media-body">
            <h3 class="dropdown-item-title "> ticket_{{$notify->data['ticket_id']}}
              <span class="float-right text-sm text-danger">
                <i class="fas fa-star"></i>
              </span>
            </h3>
              <a href="{{ url('tickets/'. $notify->data['ticket_id']) }}"> #{{ $notify->data['ticket_id'] }} - {{ $notify->data['name'] }}
              </a>
             <a href="#" class="btn btn-success mark-as-read" data-id="{{ $notify->id }}"> Mark as read </a>
            <br />
          </div> 
        </div>
        <!-- Message End -->
      </a>
      @endforeach 
      
   
    </div>

  </li>
</div>