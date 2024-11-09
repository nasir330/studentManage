<div id="left-sidebar" class="sidebar">
    <div class="row">
        <div class="col-auto text-white">
            <h4>
                @if (Auth::user()->employees)
                {{ Auth::user()->employees->firstName.' '.Auth::user()->employees->lastName }}
                @elseif(Auth::user()->clients)
                {{ Auth::user()->clients->firstName.' '.Auth::user()->clients->lastName }}
                @endif
            </h4>
        </div>
        <!-- <div class="col-auto d-flex justify-content-end">
            <a href="javascript:void(0)" class="menu_option float-right">
                <i style="font-size:22px;" class="fa-solid fa-bars" data-toggle="tooltip" data-placement="left"
                    title="Grid & List Toggle"></i>
            </a>
        </div> -->
    </div>
    <nav id="left-sidebar-nav" class="sidebar-nav">
        <ul class="metismenu">
            <li class="active">
                <a href="{{route('dashboard')}}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->userType==1)
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Employee</span>
                </a>
                <ul>
                    {{-- <li>
                        <a href="{{route('admin.sendLink.employee')}}">
                            <i class="fa-solid fa-user-check"></i>
                            Send Link
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{route('admin.add.employee')}}">
                            <i class="fa-solid fa-user-check"></i>
                            Add New
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.employee.list')}}">
                            <i class="fa-solid fa-user-group"></i>
                            Employee List
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-users"></i>
                    <span>Students</span>
                </a>
                <ul>
                    {{-- <li>
                        <a href="{{route('admin.sendLink.client')}}">
                            <i class="fa-solid fa-user-check"></i>
                            Send Link
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{route('admin.add.student')}}">
                            <i class="fa-solid fa-user-check"></i>
                            Add New
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.student.list')}}">
                            <i class="fa-solid fa-user-group"></i>
                            Students List
                        </a>
                    </li>
                </ul>
            </li>
            @endif
     
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <span>Project Manage</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('admin.projects')}}">
                            <i class="fa-solid fa-user-check"></i>
                            Project List
                        </a>
                    </li>                   
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <span>Attendance</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('admin.attendence')}}">
                            <i class="fa-solid fa-user-check"></i>
                            Daily Attendance
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.attendence.report')}}">
                            <i class="fa-solid fa-file-lines"></i>
                            Attendance Report
                        </a>
                    </li>
                </ul>
            </li>
           
            
            <li>
                <a href="{{ route('admin.report') }}">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                    Activity Log
                </a>
            </li>

        </ul>
    </nav>
</div>