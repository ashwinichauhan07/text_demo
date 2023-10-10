<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid"><br>
    <div class="row mt-4">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"> <b style="font-size: 30px;">TIME TABLE {{ date('Y') }} </b></i>
             <a class="btn btn-dark" style="margin-left: 68em;" href="{{ route('instituteadmin.dashboard') }}">Back</a> </li>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Time</th>
                        @for($i=1; $i<=auth()->user()->institute->pc; $i++)
                        <th>
                            PC {{ $i }}
                         </th>
                         @endfor
                    </tr>
                </thead>
                <tbody>
                        @foreach ($Itiming as $key => $Itiming_value)
                        <tr>
                        <td>
                            <input type="time" value="{{ $Itiming_value->start_time }}" disabled> to  <input type="time" value="{{ $Itiming_value->end_time }}" disabled>

                            {{--  {{ $Itiming_value->start_time }} to {{ $Itiming_value->end_time }}  --}}
                        </td>
                        @foreach ($student_batch as $key => $studentbatch)

                        @if($Itiming_value->id == $studentbatch->batch_id)
                        @if($Itiming_value->end_time == date('h') + 1)
                        @if(Cache::has('online_user'.$studentbatch->student->user_id))
                        <td style="background-color: green; color:aliceblue;  font-weight: bold;">  {{ $studentbatch->student->user->name }} {{ $studentbatch->student->father_name }} {{ $studentbatch->student->lastname }}</td>
                        @else
                        <td style="background-color: rgb(214, 6, 6); color:aliceblue;  font-weight: bold;">  {{ $studentbatch->student->user->name }} {{ $studentbatch->student->father_name }} {{ $studentbatch->student->lastname }}</td>


                        @endif
                         @else
                         <td style="background-color:grey; color:aliceblue;  font-weight: bold;"> {{ $studentbatch->student->user->name }} {{ $studentbatch->student->father_name }} {{ $studentbatch->student->lastname }}</td>

                        @endif
                        @endif


                        @endforeach
                        </tr>
                        @endforeach
                </tbody>
               <tfoot>
                  <tr>
                    <th>Time</th>
                    @for($i=1; $i<=auth()->user()->institute->pc; $i++)
                        <th>
                            PC {{ $i }}
                         </th>
                         @endfor
                    </tr>
               </tfoot>
            </table>
        </div>
    </div>
    </div>
    </div>
</body>
{{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ url('public/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<!-- -<script src="{{ url('chartJs/chart-area-demo.js') }}"></script> -->
<script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script> -
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
<script>
    $(document).ready( function () {
    $('#dataTable').DataTable();
} );
    </script>

</html>
