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
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">

                                    <div class="card-body"><i class="fas fa-users"></i>&nbsp;&nbsp; Total Student

                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#myAnchor" rel="" id="anchor1" class="anchorLink">Add Student</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-2 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Total Instructor</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><i class="fas fa-clock"></i>&nbsp;&nbsp; Current Session
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><i class="fas fa-book-open"></i>&nbsp;&nbsp; Notice
                                </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Check Updated Notice</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body"><i class="fas fa-calendar"></i>&nbsp;&nbsp; Calender</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('instructortadmin/calender')}}">Current Month</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                        </div>
<!--
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Total Student

                            </div>
                            <div class="card-body">
                                <div class="table-responsive" name="myAnchor" id="myAnchor">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Student Photo</th>
                                        <th>Student Name</th>
                                        <th>In-Time</th>
                                        <th>Out-Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($students as $student_value)
                                    <tr>
                                        <td style="width: 25%;"><img src="{{asset('public/images')}}/{{ $student_value->student_img }}" style="width: 50% ; margin-left: 1em;" /></td>
                                        <td>{{ $student_value->user->name }}</td>
                                        <td>{{ $student_value->created_at }}</td>
                                        <td>{{ $student_value->created_at }}</td>
                                        <td> @if(Cache::has('online_user'.$student_value->user_id))
                                         <button type="submit" class="btn btn-success" style="border-radius: 50px;">Login</button>
                                         @else
                                         <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Logout</button>
                                         @endif
                                       </td>
                                    </tr>
                                </tbody>
                                    @endforeach
                                <tfoot>
                                    <tr>
                                       <th>Student Photo</th>
                                        <th>Student Name</th>
                                        <th>In-Time</th>
                                        <th>Out-Time</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                               </table>
                           </div>
                       </div>
                       </div>

                       <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"> Payment Details </i>
                                <label id="date" style="font-size: 20px;"></label>

                            </div>
                            <div class="card-body">

                                <div class="table-responsive" name="myAnchor" id="myAnchor">
                                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                       <th>Profile Photo</th>
                                        <th>Name</th>
                                        <th>Email Id</th>
                                        <th>Mobile No</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @if($instructorPayment != null)
                                         <td style="width: 25%;"><img src="{{asset('public/images')}}/{{ $instructorPayment->instructor->identity_img }}" style="width: 50% ; margin-left: 1em;" /></td>
                                         <td>{{ $instructorPayment->instructor->user->name }}</td>
                                         <td>{{ $instructorPayment->instructor->user->email }}</td>
                                         <td>{{ $instructorPayment->instructor->phone_no }}</td>
                                         <td><a href="{{ route('instructortadmin.payment') }}" class="btn btn-info"><i class="fa fa-info"></i></i></a>
                                         &nbsp;&nbsp;<br><br></td>

                                         @endif

                                </tbody>
                                <tfoot>
                                    <tr>

                                        <th>Profile Photo</th>
                                        <th>Name</th>
                                        <th>Email Id</th>
                                        <th>Mobile No</th>
                                        <th>Action</th>


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
        $('a').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    },1000);
    return false;
});
    </script>
    	{{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

        </script>

        <script>
            $(document).ready(function(){
                $("#myModal").modal('show');
            });
        </script>

         <script type="text/javascript">


          $(document).ready( function () {
          $('#myTable').DataTable();
      } );

          $(document).ready( function () {
          $('#dataTable').DataTable();
      } );
        </script>
    @endpush
@endonce
