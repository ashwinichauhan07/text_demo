@extends('layouts.admin')

@section('title', 'Exam Time Table')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">

                <i class="fas fa-table mr-1"> Student Hall-Ticket List </i>
            <!--  <a href="{{ route('pdf.hallticket_time_table') }}" class="btn btn-dark float-right" style="margin-left: 1em;"><i class="fas fa-print"></i>
                  -->
                    <a href="{{ route('hallticket.create') }}" class="btn btn-dark float-right">Create Hall Ticket</a>
            </div>
            <div class="col-xl-12">
                <div class="card-body">
                @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif  

                 @if ($message = Session::get('status'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                 @endif  

                 @if ($message = Session::get('edit'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                 @endif   
              
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Student Subject</th>
                <th>Exam Date</th>
                <th>Batch Number</th>
                <th>Exam Start Time</th>
                <th>Exam End Time</th>
                <th>Institute Center Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
               @foreach($hallticketData as $key => $hallticket_value)
            <tr>
                <td>{{ $key++ }}</td>
                <td>{{ $hallticket_value->student->user->name}} {{ $hallticket_value->student->father_name}} {{ $hallticket_value->student->lastname}}</td>
                <td>{{ $hallticket_value->subject->name }}</td>
                <td>{{ $hallticket_value->exam_date }} ({{ $hallticket_value->day }})</td>
                <td>{{ $hallticket_value->batch }}</td>
                <td><input type="time"value="{{ $hallticket_value->start_time }}" disabled>{{ $hallticket_value->start_time }}</td>
                <td><input type="time"value="{{ $hallticket_value->end_time }}" disabled>{{ $hallticket_value->end_time }}</td>
                <td>{{ auth()->user()->name }}</td>
                <td> 
                    <form action="{{ route('hallticket.destroy', $hallticket_value->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                        @if(auth()->user()->userType == 2)

                        <a href="{{ route('hallticket.edit',[ $hallticket_value->id ]) }}" class="btn btn-primary edit"><i class="fas fa-edit"></i></a>&nbsp; &nbsp;<br><br>

                        @endif

                        <a href="{{ route('pdf.hallticket',[ $hallticket_value->id ]) }}" class="btn btn-info fas fa-print"></i></a>&nbsp; &nbsp;<br><br>

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
                <th>#</th>
                <th>Student Name</th>
                <th>Student Subject</th>
                <th>Exam Date</th>
                <th>Batch Number</th>
                <th>Exam Start Time</th>
                <th>Exam End Time</th>
                <th>Institute Center Name</th>
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
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

          <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

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
            window.onload = ()=> {
                var del = document.querySelectorAll(".delete");
                del.forEach(function(item, index){
                    item.onclick = ()=> {
                        if (confirm("Are you sure you want to delete !")) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                });
            }
        </script>

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

                  { extend: 'pdf', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                  { extend: 'print', className: 'btn btn-dark glyphicon glyphicon-duplicate' },

                     ]
            });

              table.buttons().container()
             .appendTo( '#example_wrapper .col-md-6:eq(0)' );
          } );
        </script>

      
    @endpush
@endonce