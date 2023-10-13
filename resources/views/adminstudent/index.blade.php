@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area mr-1"> Student By Day </i>
                        </div>
                        <div class="card-body">
                            <canvas id="myAreaChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"> Student In this Institute </i>
                        </div>
                        <div class="card-body">
                            <canvas id="myPieChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"> Student Details List </i>
                </div>
                <div class="col-xl-12">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <div class="form-group col-md-4 " style="display: inline-block;">
                                <form>
                                    <label for="name">Institute Name</label>

                                    <select id="institute_id" class="form-control js-example-basic-single" name="name">
                                        <option value="" name="name">Choose Institute Name...</option>

                                        @foreach($instituteData as $key=> $institute_value)


                                            <option
                                                value="{{ $institute_value->id }}">{{ $institute_value->name }}</option>


                                        @endforeach
                                    </select>


                            </div>
                            <div style="display: inline-block;">
                                <button type="submit" class="btn btn-dark">Search</button>
                            </div>

                            </form>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    {{--								<th>Student Photo</th>--}}
                                    <th>Student Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Session</th>
                                    <th>Year</th>

                                    <th>Addmission Date</th>
                                    <th>Status</th>
                                    <!-- <th>Subject Name</th> -->
                                    <!-- <th>Details</th>
                                    <th>Log Out</th>
                                    <th>M/C Name</th> -->

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($studentData as $student)
                                    <tr>
                                        {{--									<td><img src="{{asset('public/images')}}/{{ $student->student_img }}" style="width: 50% ;" /></td>--}}
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->student_mob}}</td>
                                        <td>{{ $student->user->email }}</td>
                                        <td>
                                            @foreach($student->student_subject as $subject_value)
                                                {{ $subject_value->subject->name }},
                                            @endforeach
                                        </td>
                                        <td>{{ $student->isession->start_session }}
                                            to {{ $student->isession->end_session }}</td>

                                        <td>{{ $student->doaddmission }}</td>
                                        <td>{{ $student->year }}</td>
                                        <td>
                                            @if(Cache::has('online_user'.$student->user_id))
                                                <button type="submit" class="btn btn-success"
                                                        style="border-radius: 50px;">Login
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-danger"
                                                        style="border-radius: 50px;">Logout
                                                </button>
                                            @endif
                                        </td>
                                    <!-- <td>{{ $student->subject_id }}</td> -->

                                    <!--  <td>

          		      		<form action="{{ route('students.destroy',$student->id) }}" method="POST">

          		<a class="btn btn-info" href="{{ route('students.show',$student->id) }}"><i class="fas fa-eye"></i></a><br><br>

          					<a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}"><i class="fas fa-edit"></i></a><br><br>

          					@csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                               </td>-->

                                        @endforeach
                                    </tr>
                                </tbody>

                                <tfoot>
                                <tr>
                                    {{--								<th>Student Photo</th>--}}
                                    <th>Student Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Session</th>
                                    <th>Year</th>

                                    <th>Addmission Date</th>
                                    <th>Status</th>
                                    <!-- <th>Subject Name</th> -->
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@once
    @push('scripts')
        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';
            var cData = JSON.parse(`<?php echo $chart_data; ?>`);

            // Area Chart Example
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: cData.label,
                    datasets: [{
                        label: "Users Count",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: cData.data,
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: cData.count,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        </script>

        <script type="text/javascript">

            $(document).ready(function () {
                $('.js-example-basic-single').select2();
            });

            //    window.onload = ()=>{

            //        var institute_id = document.getElementById('institute_id');


            //        institute_id.onchange =()=>{

            //        console.log(institute_id);

            //        var formData = new FormData
            //            // formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
            //            formData.append("institute_id", institute_id.value);

            //            var xhttp = new XMLHttpRequest();
            //        xhttp.onreadystatechange = function(){
            //            if (this.readyState == 4 && this.status == 200) {
            //          console.log(this.responseText);
            //          var response = JSON.parse(this.responseText);
            //            // console.log(response.status);
            //          if (response.status) {
            //           // console.log(response.data);
            //           // console.log(course_id.options.length=0);
            //           course_id.options.length=0;
            //           for (var i = 0; i <= response.data.length; i++) {
            //             // console.log(response.data[i].course_id);
            //             //console.log(response.data.length);

            //             var opt = document.createElement("option");
            //             opt.innerText = response.data[i].course.name;
            //             opt.value = response.data[i].course.id;
            //             course_id.append(opt);
            //             // console.log(opt);
            //           }

            //          }
            //        }
            //      };

            //
            // }
            //        }


        </script>



    @endpush
@endonce
