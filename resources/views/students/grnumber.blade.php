@extends('layouts.admin')

@if(auth()->user()->userType == 2)
  @section('title', auth()->user()->name)



@elseif(auth()->user()->userType == 3)
  @section('title', auth()->user()->instructor->institute->user->name)

@endif


@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">

       <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Student General Register</li>
                         </ol>
        <div class="card mb-4">

            <div class="col-xl-12">
                <div class="card-body">

                    <form>

                     <div class="form-row">

                   <div class="form-group col-md-6">
                <label for="session_id">Student Session</label>
                <select id="isession_id" class="form-control" name="isession_id">
                      <option value="" name="isession_id" >Choose Sesssion...</option>

                    @foreach($isessions as $key=> $session_value)

                    <option value="{{ $session_value->id }}">{{ $session_value->month->month_name }}&nbsp;to&nbsp;{{ $session_value->monthname->month_name }}</option>

                    @endforeach
                    </select>
              </div>

                 <div class="form-group col-md-6">
                     <label for="firstname">Enter Year</label>
                     <input type="text" class="form-control" name="year" placeholder="Enter Year" value="">


                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-dark" name="student" value="student_gr">GR Register Student_wise</button>
             <button type="ooo" class="btn btn-dark" name="subject" value="subject_gr">GR Register Subject_wise</button>
              </div>
                </div>
                </div>
                </form>
        </div>


              <div class="x_panel">
              <div class="table-responsive">
                <!-- <button id="print" class="btn btn-dark" style="margin-bottom: 10px;">Print</button> -->
               <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">

              <thead>

          <tr>
            <th>No</th>
            <th>GR No</th>
            <th>Student Name</th>
            <th>Mother Name</th>
            <th>Admission Date</th>
            <th>Address</th>
            <th>Birth Date</th>
            <th>Education</th>
            <th>School/College</th>
            <th>Adhar Card No</th>
          </tr>
        </thead>
        <tbody>
         @foreach($studentData as $key => $student_value)
         <tr>
            <td>{{$key++}}</td>
            <td>{{ $student_value->student_grno->student_grno }}</td>
            <td>{{ $student_value->user->name }} {{ $student_value->father_name }} {{ $student_value->lastname }}</td>
            <td>{{ $student_value->mother_name }}</td>
            <td>{{ $student_value->doaddmission }}</td>
            <td>{{ $student_value->address }}</td>
            <td>{{ $student_value->dob }}</td>
            <td>{{ $student_value->education }}</td>
            <td>{{ $student_value->school }}</td>
            <td>{{ $student_value->identity_number }}</td>

         </tr>
         @endforeach
       </tbody>
          <tfoot>
            <tr>
             <th>No</th>
            <th>GR No</th>
            <th>Student Name</th>
            <th>Mother Name</th>
            <th>Admission Date</th>
            <th>Address</th>
            <th>Birth Date</th>
            <th>Education</th>
            <th>School/College</th>
            <th>Adhar Card No</th>
          </tr>

          </tfoot>
        </table>
</div>
</div>
<div>
              <!-- <div class="x_panel">
              <div class="table-responsive"> -->
                <!-- <button id="print" class="btn btn-dark" style="margin-bottom: 10px;">Print</button> -->
               <table class="table table-striped table-bordered" id="dataTableid" width="100%" cellspacing="0">
              <thead>

          <tr>

            <th>No</th>
            <th>Subject Wise GR No</th>
            <th>Subject</th>
            <th>Student Name</th>
            <th>Mother Name</th>
            <th>Admission Date</th>
            <th>Address</th>
            <th>Birth Date</th>
            <th>Education</th>
            <th>School/College</th>

            <th>Adhar Card No</th>
          </tr>
        </thead>
        <tbody>
         @foreach($subjectgr_Data as $key => $student_value)
         <tr>
          <td>{{$key++}}</td>
           <td>{{ $student_value->subject_grno }}</td>
           <td>{{ $student_value->subject->name }}</td>
           <td>{{ $student_value->student->user->name }} {{ $student_value->student->father_name }} {{ $student_value->student->lastname }}</td>
           <td>{{ $student_value->student->mother_name }}</td>
           <td>{{ $student_value->student->doaddmission }}</td>
           <td>{{ $student_value->student->address }}</td>
           <td>{{ $student_value->student->dob }}</td>
          <td>{{ $student_value->student->education }}</td>
           <td>{{ $student_value->student->school }}</td>
           <td>{{ $student_value->student->identity_number }}</td>
         </tr>
         @endforeach
       </tbody>
          <tfoot>
            <tr>
             <th>No</th>
            <th>Subject Wise GR No</th>
            <th>Subject</th>
            <th>Student Name</th>
            <th>Mother Name</th>
            <th>Admission Date</th>
            <th>Address</th>
            <th>Birth Date</th>
            <th>Education</th>
            <th>School/College</th>

            <th>Adhar Card No</th>
          </tr>

          </tfoot>
        </table>
</div>
</div>
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
    <!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="{{ url('chartJs/chart-area-demo.js') }}"></script> -->

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

                  { extend: 'copy', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  { extend: 'csv', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  {  extend: 'excel',

                     className: 'btn btn-dark glyphicon glyphicon-duplicate',

                     title: '{{ auth()->user()->name }}',

                     messageTop: '{{ auth()->user()->institute->address }},' + "\n" + 'Enrollment Number:-{{ auth()->user()->institute->institute_code }}, General Register for session : {!! $choose_session !!}, {{ $grtype }}',

                  },

                  { extend: 'pdf', className: 'btn btn-dark glyphicon glyphicon-duplicate', download: 'open'
 },

                  { extend: 'print', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                     ]
            });

              table.buttons().container()
             .appendTo( '#example_wrapper .col-md-6:eq(0)' );
          } );
        </script>

         <script type="text/javascript">

          $(document).ready( function () {

            // var print = document.getElementById("print");
            // print.onclick = ()=> {
            //     print.style.display = "none";
              $('#dataTableid').DataTable( {
                dom: 'Bfrtip',
                buttons: [

                  { extend: 'copy', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  { extend: 'csv', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  {  extend: 'excel',

                     className: 'btn btn-dark glyphicon glyphicon-duplicate',

                     title: '{{ auth()->user()->name }}',

                     messageTop: '{{ auth()->user()->institute->address }}, Enrollment Number:-{{ auth()->user()->institute->institute_code }}, General Register for session : {!! $choose_session !!}, {{ $grtype }}',

                     download: 'open'

                  },

                  { extend: 'pdf', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  { extend: 'print', className: 'btn btn-dark glyphicon glyphicon-duplicate' },      ]
            });
              table.buttons().container()
             .appendTo( '#example_wrapper .col-md-6:eq(0)' );
          } );
        </script>

    @endpush
@endonce
