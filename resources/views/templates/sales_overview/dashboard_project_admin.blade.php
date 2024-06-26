@php
    use Illuminate\Support\Facades\DB;
@endphp
<div class="col-xl-8 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee Work Log Status</h3>
            <div class="card-options">
            </div>
        </div>
        <div class="card-body">
            <!-- on-progress work table start -->
            <div class="table-responsive">
                @if (!empty($employees))
                    <table class="table table-hover table-striped text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Phone</th>
                                <th>Current Project</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $key => $employee)
                                {{-- check employee profile status start --}}
                                @if (!empty($employee->status))
                                    @if (!empty($employee->employeeLogs))
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-left">
                                                <div id="tablePhoto">
                                                    <img src="{{ asset('') }}{{ $employee->photo }}"
                                                        class="img-fluid" alt="User Image">
                                                    <span class="statusDot">
                                                        @if ($employee->employeeLogs->status == 'start')
                                                            <span class="onlinex-dot onlinex"></span>
                                                        @elseif(in_array($employee->employeeLogs->status, ['Prayers_Break', 'Lunch_Break', 'Dinner_Break', 'Others_Break']))
                                                            <span class="onlinex-dot breakex"></span>
                                                        @elseif($employee->employeeLogs->status == 'back')
                                                            <span class="onlinex-dot onlinex"></span>
                                                        @else
                                                            <span class="onlinex-dot offlinex"></span>
                                                        @endif
                                                    </span>
                                                </div>
                                                {{ $employee->nickName }}
                                            </td>
                                            <td>{{ $employee->phone1 }}</td>
                                            <td>
                                                @if (empty($employee->projectManage))
                                                    {{ 'NA' }}
                                                @else
                                                    {{ $employee->projectManage->projects->title }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($employee->employeeLogs->status == 'start')
                                                    <strong class="text-success">{{ 'Online' }}</strong>
                                                @elseif(in_array($employee->employeeLogs->status, ['Prayers_Break', 'Lunch_Break', 'Dinner_Break', 'Others_Break']))
                                                    <strong class="text-warning">{{ 'Break' }}</strong>
                                                @elseif($employee->employeeLogs->status == 'back')
                                                    <strong class="text-success">{{ 'Online' }}</strong>
                                                @else
                                                    <strong class="text-danger">{{ 'Offline' }}</strong>
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-left">
                                                <div id="tablePhoto">
                                                    <img src="{{ asset('') }}{{ $employee->photo }}"
                                                        class="img-fluid" alt="User Image">
                                                    <span class="statusDot">
                                                       <span class="onlinex-dot offlinex"></span>
                                                    </span>
                                                </div>
                                                {{ $employee->nickName }}
                                            </td>
                                            <td>{{ $employee->phone1 }}</td>
                                            <td>
                                                @if (empty($employee->projectManage))
                                                    {{ 'NA' }}
                                                @else
                                                    {{ $employee->projectManage->projects->title }}
                                                @endif
                                            </td>
                                            <td>                                               
                                                    <strong class="text-secondary">{{ 'Not Started' }}</strong>
                                            </td>
                                        </tr>
                                    @endif                                    
                                @else
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-left">
                                            {{ $employee->nickName }}
                                        </td>
                                        <td>{{ $employee->phone1 }}</td>
                                        <td>
                                            @if (empty($employee->projectManage))
                                                {{ 'NA' }}
                                            @else
                                                {{ $employee->projectManage->projects->title }}
                                            @endif
                                        </td>
                                        <td>
                                            <strong class="text-warning">{{ 'Profile Not Set' }}</strong>
                                        </td>
                                    </tr>
                                @endif
                                {{-- check employee profile status start --}}
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
