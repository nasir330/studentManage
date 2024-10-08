<div id="left-sidebar" class="sidebar">
    <div class="row">
        <div class="col-auto text-white">
            <h4>
            {{ Auth::user()->employees->firstName.' '.Auth::user()->employees->lastName }}
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
                <a href="{{route('dashboard.employee')}}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
         
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <span>Current Project</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('employee.projects',Auth::user()->id)}}">
                            <i class="fa-solid fa-user-check"></i>
                            Start Work
                        </a>
                    </li>
                    <li>
                        <a href="{{route('employee.work.logs')}}">
                            <i class="fa-solid fa-file-lines"></i>
                            Work Logs
                        </a>
                    </li>
                </ul>
            </li>
            <!-- <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <span>Attendance</span>
                </a>
                <ul>
                    <li>
                        <a href="login.html">
                            <i class="fa-solid fa-user-check"></i>
                            Daily Attendance
                        </a>
                    </li>
                    <li>
                        <a href="login.html">
                            <i class="fa-solid fa-file-lines"></i>
                            Attendance Report
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-bed"></i>
                    <span>Leaves</span>
                </a>
                <ul>
                    <li>
                        <a href="login.html">
                            <i class="fa-solid fa-plus"></i>
                            Add Leaves
                        </a>
                    </li>
                    <li>
                        <a href="login.html">
                            <i class="fa-solid fa-sliders"></i>
                            Manage Leaves
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-coins"></i>
                    <span>Payrolls</span>
                </a>
                <ul>
                    <li>
                        <a href="login.html">
                            <i class="fa-solid fa-ticket"></i>
                            Create Payslip
                        </a>
                    </li>
                    <li>
                        <a href="login.html">
                            <i class="fa-solid fa-list"></i>
                            Payslip List
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c">
                    <i class="fa-solid fa-flag"></i>
                    <span>Holidays</span>
                </a>
                <ul>
                    <li>
                        <a href="login.html">
                            <i class="fa-solid fa-plus"></i>
                            Add Holiday
                        </a>
                    </li>
                    <li>
                        <a href="login.html">
                            <i class="fa-solid fa-sliders"></i>
                            Manage Holiday
                        </a>
                    </li>
                </ul>
            </li>
            
            <li>
                <a href="login.html">
                    <i class="fa-solid fa-file-csv"></i>
                    Activity Log
                </a>
            </li> -->

        </ul>
    </nav>
</div>