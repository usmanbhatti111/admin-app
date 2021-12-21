<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{url('admin_template/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{url('admin_template/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{url('admin_template/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">Profile</span>
        </a>
       
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{url('edit/profile/'.encrypt(Auth::id()))}}"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                    <a class="dropdown-item" data-target="#modal_change_password" data-toggle="modal"  
                    id="change_password_he"
                    href="javascript:;" ><i class="dripicons-wallet text-muted mr-2"></i>Change Password</a>
                    <a class="dropdown-item d-block" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                    @if (Route::has('login'))
                        @auth
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                            href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                <i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    @endif
                </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>

    <div class="modal fade" id="modal_change_password" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>
        <div class="modal-body">
            <p class="text-success text-center " id="success_msg">  </p>    
            <form  
            {{-- action="{{url('save-change-password')}}"  --}} id="change_password_form"
             method="POST"> 
                @csrf 
                <input type="hidden" value="{{encrypt(Auth::user()->id)}}" name="id">
                    <div class="row">
                                <div class="col-md-12">
                                   
                                    <div class="form-group mb-1">
                                        <label for="old-passwor" class="control-label">Old Password</label>
                                        <input autocomplete="off" name="current_password" type="password" id="old-password" class="form-control {{ $errors->has('current_password') ? ' has-error' : '' }}"  placeholder="Old Password">
                                    </div>
                                    <span class="text-danger " id="error_current_password">  </span>                                
                                </div>
                               <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <label for="new-password" class="control-label">New Password</label>
                                        <input autocomplete="off" name="new_password" type="password" id="new-password" class="form-control {{ $errors->has('new_password') ? ' has-error' : '' }}"  placeholder="New Password">
                                    </div>
                                   
                                    <span class="text-danger " id="error_new_password">  </span>  
                                </div>
                                <div class="col-md-12">
                                <div class="form-group mb-1">
                                    <label for="change-password" class="control-label">Confirm Password</label>
                                    <input autocomplete="off"  name="password_confirmation" type="password" id="confirm-new-password"  class="form-control {{ $errors->has('password_confirmation') ? ' has-error' : '' }}"  placeholder="Confirm Password">
                                </div>
                                
                                <span class="text-danger " id="error_password_confirmation">  </span>  
                                 </div>
                    </div>                                          
                    <button type="submit" class="btn btn-success pull-right mt-1 " id="change_password">Change</button> 
            </form>
        </div> 
    </div>
    <!-- /.modal-content -->
    </div>      
</div>
  </nav>