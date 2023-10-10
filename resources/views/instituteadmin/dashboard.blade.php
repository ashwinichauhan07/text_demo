@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid">
            <h1 class="mt-4"></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body"><i class="fas fa-users"></i>&nbsp;&nbsp;
                            Total Regular Student &nbsp;&nbsp;{{ $regular_student }}

                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('students.index')}}" rel=""
                               id="anchor1" class="anchorLink">Add Student</a>
                            <div class="small text-white">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body"><i class="fas fa-users"></i>&nbsp;&nbsp;
                            Total Repeat Student &nbsp;&nbsp;
                            {{ count($student_repeat)}}

                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('students.repeat_index') }}">Show
                                Student</a>
                            <div class="small text-white">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body"><i class="fas fa-users"></i>&nbsp;&nbsp;
                            Total Instructor &nbsp;&nbsp;
                            {{ count($instructors)}}
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('instructors.index') }}">Add
                                Instructor</a>
                            <div class="small text-white">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-dark text-white mb-3">
                        <div class="card-body"><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;
                            Revenue &nbsp;&nbsp;

                            {{ $revenue }}

                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('studentinstallments.revenue')}}">Revenue
                                Report</a>
                            <div class="small text-white">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-body"><i class="fas fa-clock">
                            </i>&nbsp;&nbsp;
                            Session
                             <a class="btn btn-dark" href="{{ route('instituteadmin.timetable') }}" class="btn btn-default" style="margin-left: 21em">Live time table</a>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between">
                        <!--   <a class="small text-white stretched-link" href="{{ route('studentinstallments.session')}}">Session Details</a> -->

                            <form>
                                <div style="display:inline-block;">
                                    <label for="session_id">Student Session</label>
                                    <select id="isession_id" class="form-control" name="isession_id">
                                        <option value="" name="isession_id">Choose Sesssion...</option>

                                        @foreach($isessions as $key=> $session_value)

                                            <option
                                                value="{{ $session_value->id }}">{{ $session_value->month->month_name }}
                                                &nbsp;to&nbsp;{{ $session_value->monthname->month_name }}</option>

                                        @endforeach
                                    </select>

                                </div>
                                <div style="display:inline-block;">

                                    <label for="firstname">Enter Year</label>
                                    <input type="text" class="form-control" name="year" placeholder="Enter Year"
                                           value="">
                                </div>
                                <div style="display:inline-block; padding-left: 10px;">
                                    <button class="btn btn-light">Search</button>
                                </div>
                            </form>

                            <div class="small text-white">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>

                    </div>

                </div>

            <!--   <div class="col-xl-2 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body"><i class="fas fa-calendar"></i>&nbsp;&nbsp; Calender</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="{{route('instituteadmin/calender')}}">Current Month</a>
                                <div class="small text-white">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div> --->
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-users">Active Student</i>
                        </div>
                        <div class="card-body">

                            <p style="font-size: 100px; height: 185px;" class="text-center">{{ count($onlineUser) }}</p>
                            Session
                            <!-- <canvas id="myAreaChart" width="100%" height="40"></canvas> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"> Bar Chart Example </i>
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"> Total Student {{ count($students) }} </i>

                </div>
                    <div class="card-body">

                        <div class="table-responsive" name="myAnchor" id="myAnchor">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" class="display">
                            <thead>
                            <tr>
                                <th>Student Photo</th>
                                <th>Student Name</th>
                                <th>Mobile No</th>
                                <th>Subject</th>
                                <th>Batches</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td><img src="{{asset('public/images')}}/{{ $student->student_img }}"
                                             style="width: 30% ;"/></td>
                                    <td>{{ $student->user->name }} &nbsp;&nbsp;
                                        {{ $student->father_name }}&nbsp;&nbsp;
                                        {{ $student->lastname }}</td>
                                    <td>{{ $student->student_mob }}</td>
                                    <td>
                                        @foreach ($student->student_subject as $key => $subject_value)

                                            @if($subject_value->old == 0)

                                    {{ $subject_value->subject->name }}&nbsp;,&nbsp;

                                            @endif

                                        @endforeach
                                    </td>
                                    <!-- </td> -->
                                <!-- <td>{{ $student->updated_at }}</td>
                                        <td> @if(Cache::has('online_user'.$student->user_id))
                                    <button type="submit" class="btn btn-success" style="border-radius: 50px;">Login</button>
@else
                                    <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Logout</button>
@endif
                                    </td> -->
                                    <!-- <td> -->
                                    <td width="15%;">
                                        @foreach ($student->student_batch as $key => $student_value)
                                            @php echo date('h:i A', strtotime($student_value->itiming->start_time)) @endphp&nbsp;to&nbsp;
                                            @php echo date('h:i A', strtotime($student_value->itiming->end_time)) @endphp</option>
                                            <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if(Cache::has('online_user'.$student->user_id))
                                            <button type="submit" class="btn btn-success" style="border-radius: 50px;width: 40px; height: 40px;"></button>
                                        @else
                                            <button type="submit" class="btn btn-danger" style="border-radius: 50px; width: 40px; height: 40px;"></button>
                                        @endif
                                    </td>
                                    <td>
{{--                                        <a href="" class="btn btn-primary">Extend Time</a>--}}
                                        @if($student->user->typing_id == null)
                                            <a href="{{ route('students.lock',$student->user_id) }}"
                                               class="btn btn-danger" data-toggle="l"><i class="fas fa-lock"></i></a>
                                         @elseif($student->user->typing_id == 1)
                                            <a href="{{ route('students.unlock',$student->user_id) }}"
                                    class="btn btn-success"><i class="fa fa-unlock"></i></a>
                                            @endif
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Student Photo</th>
                                <th>Student Name</th>
                                <th>Mobile No</th>
                                <th>Subject</th>
                                <th>Batches</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"> List of Student didn't paid current month installment: </i>
                    <label id="date" style="font-size: 20px;"></label>

                </div>
                <div class="card-body">

                    <div class="table-responsive" name="myAnchor" id="myAnchor">
                        <table class="table table-striped table-bordered" id="myTable" width="100%" cellspacing="0"
                               class="display">
                            <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Student Photo</th>
                                <th>Student Name</th>
                                <th>Subject</th>
                                <th>Balance Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $page =0; @endphp
                            @foreach ($students as $student)
                                @if($currentdata != $student->currentmonth)

                                    {{--                                            @if()--}}

                                    {{--                                        @foreach ($student->installments as $student_v)--}}

                                    @if($student->unpaidfees != 0)
                                        @if($student->date != $currentdata)
                                            <tr>
                                                <td>{{ $page += 1 }}</td>
                                                <td style="width: 250px;"><img
                                                        src="{{asset('public/images')}}/{{ $student->student_img }}"
                                                        style="width: 30%;"></td>
                                                <td>{{ $student->user->name }}&nbsp;&nbsp;{{ $student->father_name }}
                                                    &nbsp;&nbsp;{{ $student->lastname }}</td>
                                                <td>

                                                    @foreach ($student->student_subject as $key => $subject_value)

                                                        @if($subject_value->old == 0)

                                                            {{ $subject_value->subject->name }}&nbsp;,&nbsp;

                                                        @endif

                                                    @endforeach

                                                </td>
                                                <td>{{ $student->unpaidfees }}  </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                            {{--                                    @endforeach--}}

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Sr.No</th>
                                <th>Student Photo</th>
                                <th>Student Name</th>
                                <th>Subject</th>
                                <th>Balance Amount</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @foreach($custemNotification as $notification)
    @endforeach

@endsection

@once
    @push('scripts')
        <script>
            $('a').click(function () {
                $('html, body').animate({
                    scrollTop: $($(this).attr('href')).offset().top
                }, 1000);
                return false;
            });
        </script>

        {{--  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

        {{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>  --}}  --}}

        {{--  <script src="{{ url('public/js/scripts.js') }}"></script>

        {{--  <script src="{{ url('public/js/bootstrap.bundle.min.js') }}"></script>  --}}

        <script src="{{ url('public/js/jquery-3.5.1.slim.min.js') }}"></script>

        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
   <script src="{{ url('public/assets/js/Chart.min.js') }}"></script>

   <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="{{ url('public/chartJs/chart-bar-demo.js') }}"></script>  --}}

        <link rel="stylesheet" href="{{ url('public/css/font-awesome.min.css') }}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
                crossorigin="anonymous"></script>

        <!-- <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script> -->

        <script>
            window.onload = function () {
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                ;
                var date = new Date();

                {{--console.log({{ $student }});--}}

                document.getElementById('date').innerHTML = months[date.getMonth()] + ' ' + date.getFullYear();
            };
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('table.display').DataTable();
            });
        </script>

        <script type="text/javascript">

            $(document).ready(function () {
                $('#myTable').DataTable();
            });

            $(document).ready(function () {
                $('#dataTable').DataTable();
            });
        </script>

        </script>
    @endpush
@endonce
