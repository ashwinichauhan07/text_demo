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
            <i class="fas fa-chart-area mr-1"> Institute By Day </i>
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
        <i class="fas fa-table mr-1"> Institute List </i>
          <a href="{{ route('institute.create') }}" class="btn btn-dark float-right">Add Institute</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Institute Name</th>
              <th>Institute Email</th>
              <th>Principle Name</th>
              <th>Principle Mob</th>
              <th>Principle Email</th>
              <th>Address</th>
              <!-- <th>Institute Code</th> -->
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        <tbody>
        @foreach($instituteData as $key => $institute_value)
          <tr>
            <td>{{ $institute_value->user->name }}</td>
            <td>{{ $institute_value->user->email}}</td>
            <td>{{ $institute_value->principle_name }}</td>
            <td>{{ $institute_value->principle_mob }}</td>
            <td>{{ $institute_value->principle_email }}</td>
            <td>{{ $institute_value->address }}</td>
            <!-- <td>{{ $institute_value->institute_code }}</td> -->
            <td> @if(Cache::has('online_user'.$institute_value->user_id))
                       <button type="submit" class="btn btn-success" style="border-radius: 50px;">Active</button>
                     @else
                       <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Deactive</button>
                     @endif
                   </td>
            <td>
                <a href="{{ route('institute.show',[ $institute_value->id ]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <br><br>
                <a href="{{ route('institute.edit',[ $institute_value->id ]) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>&nbsp; &nbsp;<br><br>

                <form method="POST" action="{{ route('institute.destroy',[ $institute_value->id ]) }}">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="DELETE">
                    <span class="glyphicon glyphicon-trash"></span>
                    <button type="submit"class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>
                    
                </form> 
              
              </td>
            </tr>
            @endforeach
            </tbody>
          <tfoot>
            <tr>
              <th>Institute Name</th>
              <th>Institute Email</th>
              <th>Principle Name</th>
              <th>Principle Mob</th>
              <th>Principle Email</th>
              <th>Address</th>
             <!--  <th>Institute Code</th> -->
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- -<script src="{{ url('chartJs/chart-area-demo.js') }}"></script> -->
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script> -
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
          window.onload = ()=> {
            var del = document.querySelectorAll(".delete");
            del.forEach(function(item, index) {
              item.onclick = ()=> {
                if (confirm("Are you sure to delete it !")) {
                  return true;
                } else {
                  return false;
                }
              }
            });
          }
        </script>

        <!-- <script type="text/javascript">
          window.onload = ()=> {
            var edit = document.querySelectorAll(".edit");
            edit.forEach(function(item, index) {
              item.onclick = ()=> {
                if (confirm("Are you sure to Edit Institute Details !")) {
                  return true;
                } else {
                  return false;
                }
              }
            });
          }
        </script> -->

    @endpush
@endonce
