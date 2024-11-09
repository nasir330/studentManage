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
                    <i class="fa-solid fa-users"></i>
                    <span>Students</span>
                </a>
                <ul>                   
                    <li>
                        <a href="{{route('employee.add.student')}}">
                            <i class="fa-solid fa-user-check"></i>
                            Add New
                        </a>
                    </li>
                    <li>
                        <a href="{{route('employee.student.list')}}">
                            <i class="fa-solid fa-user-group"></i>
                            Students List
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</div>