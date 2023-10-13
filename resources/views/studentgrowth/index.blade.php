@extends('layouts.admin')

@section('title', 'Keyboard Practises')

@section('sidebar')

@parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Student Growth

                    <a class="btn btn-dark" style="margin-left: 59em;"
                   href="{{ route('instituteadmin.dashboard')}}">Back</a>


                </i>

            </div>
            <div class="col-xl-12">
                <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">      <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>FirstName</th>
                        <th>MiddleName</th>
                        <th>LastName</th>
<!--                         <th>Profile Photo</th>
 -->
                        <th>Addmission Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($students_report as  $key => $student)
                        <tr>

                         <td>{{$loop->index+1}}</td>
                         <td>{{ $student->user->name }}</td>
                         <td>{{ $student->father_name }}</td>
                         <td>{{ $student->lastname }}</td>

                         <td>{{ $student->doaddmission }}</td>
                         <td>

                    <a class="btn btn-primary"
                     href="{{ route('studentgrowth.viewresult',$student->id)}}">
                                <i class="fas fa-search"></i></a>

                         </td>

                         </tr>

                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>Sr.No</th>
                        <th>FirstName</th>
                        <th>MiddleName</th>
                        <th>LastName</th>
<!--                         <th>Profile Photo</th>
 -->
                        <th>Addmission Date</th>
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
        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script type="text/javascript">
            window.onload = ()=> {
                var del = document.querySelectorAll(".delete");
                del.forEach(function(item, index) {
                    item.onclick = ()=> {
                        if (comfirm("Are you sure you want to delete it!")) {
                            return true;
                        }else {
                            return false;
                        }
                    }
                });
            }
        </script>

    @endpush
@endonce
