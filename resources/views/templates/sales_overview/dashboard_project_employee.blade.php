@php
    use Illuminate\Support\Facades\DB;
@endphp
<div class="col-xl-8 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Projects</h3>
            <div class="card-options">
            </div>
        </div>
        <div class="card-body">
            <!-- on-progress work table start -->
            <div class="col-md-12">
                @if (!empty($employees))
                <table class="table table-hover table-striped text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Phone</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $key => $employee)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$employee->nickName}}</td>
                            <td>{{$employee->phone1}}</td>
                            <td>
                                @php
                                if (!function_exists('getLastStatus')) {
                                    function getLastStatus($employeeId) {
                                        $lastStatus = DB::table('employee_logs')
                                            ->select('status')
                                            ->where('employeeId', $employeeId)
                                            ->orderBy('created_at', 'desc')
                                            ->limit(1)
                                            ->value('status');

                                        return $lastStatus ?? 'No Status';
                                    }
                                }
                                @endphp
                                {{-- {{ $employee->employeeLogs->status }} --}}
                                @if (Cache::has('user-is-online-'.$employee->userId))
                                    <span class="onlinex-dot onlinex" style="margin-left:20px"></span>
                                @elseif(getLastStatus($employee->userId) === 'Prayers_Break' || getLastStatus($employee->userId) === 'Lunch_Break' || getLastStatus($employee->userId) === 'Dinner_Break' || getLastStatus($employee->userId) === 'Others_Break')
                                    <span class="onlinex-dot breakex" style="margin-left:20px"></span>
                                @else
                                    <span class="onlinex-dot offlinex" style="margin-left:20px"></span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>