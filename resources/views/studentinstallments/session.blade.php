@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">

    	 <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Showing Student Outstanding Installments (Regular)</li>
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
                <button type="submit" class="btn btn-dark">Show Installment</button>
              </div>
                </div>
                </div>
                </form>
            </div>


            <div>


              <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
          <tr>
            <th>No</th>
            <th>Student Name</th>
            <th>Admission Date</th>
            <th>Total Amount {{ $total_amount }}</th>
            <th>Paid Amount {{ $total_paid_amount}}</th>
            <th>Balance Amount {{ $total_balance_amount }}</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
                    @php $page =0; @endphp
          @foreach($studentData as $key => $student_value)

          <tr>
            <td>{{ $page += 1 }}</td>
            <td>{{ $student_value->user->name }}</td>
            <td>{{ $student_value->created_at }}</td>
            <td>{{ $student_value->totalfees }}</td>
            <td>{{ $student_value->paidfees }}</td>
            <td>{{ $student_value->unpaidfees }}</td>
            <td><a href="{{ route('studentinstallments.show', $student_value->id ) }}" class="btn btn-info"><i class="fa fa-info"></i></a>
                         &nbsp;&nbsp;<br><br></td>

          @endforeach
        </tbody>
          <tfoot>
            <tr>
            <th>No</th>
            <th>Student Name</th>
            <th>Admission Date</th>
            <th>Total Amount {{ $total_amount }}</th>
            <th>Paid Amount {{ $total_paid_amount}}</th>
            <th>Balance Amount {{ $total_balance_amount }}</th>
            <th>Details</th>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('public/js/scripts.js') }}"></script>
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="{{ url('chartJs/chart-area-demo.js') }}"></script> -->

    <script src="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>

      <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

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

                  {  extend: 'excel',

                     className: 'btn btn-dark glyphicon glyphicon-duplicate',

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
    @endpush
@endonce
