@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item active">Student Attendance Registers</li>
    </ol>
    <div class="row mt-4">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-body">
            <form>
            <div class="form-row">
             <!--  <div class="form-group col-md-6">
                <label for="inputEmail4">Enter Student User Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Student User Name" value="{{ old('name') }}">
              </div> -->
              <!-- <div class="form-group col-md-4 mt-2"><br>
                <button type="submit" class="btn btn-dark">Search</button>
              </div> -->
              <div class="form-group col-md-4">
                <label for="fromdate">Select From Date</label>
                <input type="date" name="fromdate" class="form-control" placeholder="dd/mm/yyyy" value="{{ old('fromdate') }}">
              </div>
              <div class="form-group col-md-4">
                <label for="todate">Select to Date</label>
                <input type="date" name="todate" class="form-control" placeholder="dd/mm/yyyy" value="{{ old('todate') }}">
              </div>

              <div class="form-group col-md-4" >
                    <div class="time">

                  <label for="batch">Select Batch Time:</label>


                    <select id="itiming_id" class="form-control" name="itiming_id" placeholder="Select batch">
                      <!-- <option value="1" name="itiming_id" >C</option> -->
                    @foreach($itimings as $key=> $itiming_value)

                    <option name="itiming_id[]" value="{{ $itiming_value->id }}"> {{ $itiming_value->start_time }}&nbsp;to&nbsp;{{ $itiming_value->end_time }}</option>

                    @endforeach

                    </select>
                  </div>
                </div>






             <!--  <div class="form-group col-md-4 mt-2"><br>
                <button type="submit" class="btn btn-info">Print</button>
              </div>
              <br><br><br> -->
              <div class="col-xs-8 col-sm-8 col-md-8" style="text-align: center;">
                  <button type="submit" class="btn btn-dark">Download Attendance Register In Excel Sheet</button>

              </div>

            </div>
          </div>
        </div>
      </form>


              <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
          <tr>
            <th>Student ID</th>
            <th>Student Name</th>

            <th>



             </th>


          </tr>
        </thead>
        <tbody>
          @php $page =0; @endphp
          @foreach($studentData as $key => $student_value)

          <tr>
            <td>{{ $student_value->student_id }}</td>
          <td>{{ $student_value->student->user->name }}</td>
               @for ($i = $start_date[0]; $i <= $end_date[0]; $i++)

              <td>


               @if($i == $student_value->day)

               <i style="color: blue; ">P</i>

               @else

                 <i style="color: red;">A</i>

               @endif

             </td>
              @endfor

          </tr>


          @endforeach
        </tbody>
          <tfoot>
            <tr>
            <th>Student ID</th>
            <th>Student Name</th>

              <th>

             </th>


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
       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ url('chartJs/datatables-demo.js') }}"></script> -->

        <script src="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

         <script type="text/javascript">

          $(document).ready( function () {

            // var print = document.getElementById("print");
            // print.onclick = ()=> {
            //     print.style.display = "none";
              $('#dataTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [

                  // { extend: 'copy', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  // { extend: 'csv', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  { extend: 'excel', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  // { extend: 'pdf', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  // { extend: 'print', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                     ]
            });

              table.buttons().container()
             .appendTo( '#example_wrapper .col-md-6:eq(0)' );
          } );
        </script>



    @endpush
@endonce
