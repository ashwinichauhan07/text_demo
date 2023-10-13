@extends('layouts.demo')

@section('title', 'Exam')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                      <!-- Show Message -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row mt-4">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"> Exam By Day </i>

                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Studnet In this Institute
                                    </div>
                                    <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div> -->
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"> Exam List </i>



                                <a href="{{ route('exam.create') }}" class="btn btn-dark float-right">Add Exam</a>


                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Exam Name</th>
                                                <th>Batch Name</th>
                                                <th>Created</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Exam Name</th>
                                                <th>Batch Name</th>
                                                <th>Created</th>
                                                <th>Action</th>

                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            @foreach($examData as $key => $subject_expert_value)
                                            <tr>
                                                <td>{{ $key += 1 }}</td>
                                                <td>{{ $subject_expert_value->examname->name }}</td>
                                                <td>{{ $subject_expert_value->exam_batche->batch_number }}</td>

                                                <td>{{ $subject_expert_value->created_at }}</td>

                                                <td>
                                                  <form method="POST" action="{{ route('exam.destroy',[$subject_expert_value->id]) }}">
                                                      {{ csrf_field() }}
                                                      <input type="hidden" name="_method" value="DELETE">
                                                      <button type="submit" class="delete"><i class="fas fa-trash" style="font-size:24px;color:red;"></i></button>
                                                  </form>

                                                    {{--<a href="{{ route('exam_conductor.edit',[$subject_expert_value->id]) }}">
                                                      <i class="fas fa-eye-dropper" style="font-size:24px;color:SteelBlue;"></i>
                                                    </a>--}}


                                                    <a href="{{ route('exam.show',[$subject_expert_value->id]) }}">
                                                      <i class="fas fa-eye" style="font-size:24px;color:green;"></i>
                                                    </a>




                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>




@endsection

@once
    @push('scripts')
    	 {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}

       <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
         <script src="{{ url('public/js/scripts.js') }}"></script>
         <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
         <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
         <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
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
                  label: "Exam Count",
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
            window.onload = ()=> {
              var del = document.querySelectorAll(".delete");
              del.forEach(function(item, index) {
                item.onclick = ()=> {
                  if (confirm("Are you sure to delete it!")) {
                    return true;
                  } else {
                    return false;
                  }
                }
              });
            }

          </script>
    @endpush
@endonce
