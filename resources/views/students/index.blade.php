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
        <i class="fas fa-table mr-1">Student Details List </i>
          <a href="{{ route('students.create') }}" class="btn btn-dark float-right">Add Student</a>
      </div>
      <div class="col-xl-12">
        <div class="card-body">
        @if (session('status'))
      	    <div class="alert alert-success">
      	        {{ session('status') }}
      	    </div>
      	@endif
        <div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
                <th>Sr.No</th>
                <th>Student Photo</th>
                <th>Student Name</th>
                <th>Mobile No</th>
                <th>Subject</th>
                <th>Batches</th>
                <th>Action</th>
							</tr>
						</thead>
						<tbody>
              @php $page =0; @endphp
							@foreach ($students as $student)
								<tr>
                  <td>{{ $page += 1 }}</td>
									<td><img src="{{asset('public/images')}}/{{ $student->student_img }}" style="width: 50% ;" /></td>
									<td>{{ $student->user->name }}&nbsp;&nbsp;
                      {{ $student->father_name }}&nbsp;&nbsp;
                      {{ $student->lastname }}

                    </td>
									<td>{{ $student->student_mob }}</td>
									<td>
                      @foreach ($student->student_subject as $key => $subject_value)

                      @if($student->student_type == $subject_value->student_type)

                        {{ $subject_value->subject->name }}&nbsp;,&nbsp;
                      @endif

                      @endforeach
                  </td>
									<td width="15%;">
                      @foreach ($student->student_batch as $key => $student_value)
{{--
                      <input type="time" value="{{ $student_value->itiming->start_time}}" disabled>
                     <br> <label style="padding-left:2px;">to</label>
					  <input type="time" value="{{ $student_value->itiming->end_time }}" disabled>  --}}

                      @php echo date('h:i A', strtotime($student_value->itiming->start_time)) @endphp&nbsp;to&nbsp;
                      @php echo date('h:i A', strtotime($student_value->itiming->end_time)) @endphp</option>
                      <br>
                      @endforeach
                                         </td>
								<!-- 	<td> @if(Cache::has('online_user'.$student->user_id))
                       <button type="submit" class="btn btn-success" style="border-radius: 50px;">Login</button>
                     @else
                       <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Logout</button>
                     @endif
                   </td> -->
									<!-- <td>details</td> -->
									<!-- <td>{{ $student->updated_at }}</td>
									<td>PC-1</td> -->
						    <td>

          				<form action="{{ route('students.destroy',$student->id) }}" method="POST">

          					<a class="btn btn-info" href="{{ route('students.show',$student->id) }}"><i class="fas fa-eye"></i></a><br><br>

                    @if(auth()->user()->userType == 2)

          					<a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}"><i class="fas fa-edit"></i></a><br><br>

                    @endif

          					@csrf
          					@method('DELETE')

                    @if(auth()->user()->userType == 2)

          					<button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>

                    @endif
          				</form>
			         </td>
		          </tr>

							@endforeach
               </tbody>
								<tfoot>
									<tr>
                <th>Sr.No</th>
                <th>Student Photo</th>
                <th>Student Name</th>
                <th>Mobile No</th>
                <th>Subject</th>
                <th>Batches</th>
                <th>Action</th>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

          <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

          </script>
   <script src="{{ url('public/assets/js/Chart.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ url('chartJs/admin/chart-area-demo.js') }}"></script> -->
        <!-- <script src="{{ url('chartJs/admin/chart-pie-demo.js') }}"></script> -->
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script> -
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/admin/datatables-demo.js') }}"></script>

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
         // Set new default font family and font color to mimic Bootstrap's default styling
            // Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            // Chart.defaults.global.defaultFontColor = '#292b2c';

            // // Pie Chart Example
            // var ctx = document.getElementById("myPieChart");
            // var myPieChart = new Chart(ctx, {
            //   type: 'pie',
            //   data: {
            //     labels: cData.gender,
            //     datasets: [{
            //       data: cData.gender_count,
            //       backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
            //     }],
            //   },
            // });

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
