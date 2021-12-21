<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{url('/')}}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        <span class="badge badge-pill badge-danger float-right">9+</span>
                        <span>Dashboard</span>
                    </a>
                </li>
           
           
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-briefcase-check"></i>
                        <span>User Management</span>
                    </a>
                 <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{url('user')}}">Users</a></li>
                        @if(Auth::user()->hasRole('Admin'))
                        
                        <li><a href="{{url('role')}}">Roles</a></li>
                        <li><a href="{{url('permission')}}">Permissions</a></li>
                        @endif
                        <li><a href="{{url('custom')}}">Custom Form</a></li>
                        <li><a href="{{url('pdfReader')}}">PDF READER</a></li>
                  </ul>
               </li>
               
               <li>
                <a href="javascript: void(0);" class=" waves-effect ">
                     <i class="mdi mdi-briefcase-check"></i> 
                    <i class=" mdi mdi-message-processing-outline "></i> 
                    <span>Ticketing  </span>
                    <i class="dripicons-chevron-right arrow-icons "> </i>
                </a>
                <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{url('tickets')}}">Tickets</a></li>
                        

                  </ul>
            </li>
            
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->