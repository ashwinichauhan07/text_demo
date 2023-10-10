@extends('layouts.demo')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid"><br><br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1">Student Exam Batches </i>
                    <a href="{{ route('studentbatchallocation.create') }}" class="btn btn-dark float-right">Batch Allocate</a>
                </div>
                <div class="col-xl-12">
                    <div class="card-body">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

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

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Exam Name</th>
                                    <th>Batch Name</th>
                                    <th>Student Name</th>
                                    <th>Student Subject</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($exmBatch as $key => $exmbatch_value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $exmbatch_value->examname->name }}</td>

                                    <td>{{ $exmbatch_value->exam_batches->batch_number }}</td>

                                    <td>
                                        @foreach ($exmbatch_value->student as $key => $student_value)
                                        {{ $student_value->user->name }} {{ $student_value->user->student->father_name }} {{ $student_value->user->student->lastname }},
                                        @endforeach
                                    </td>
                                    <td>{{ $exmbatch_value->subject->name }}</td>
                                    <td>
                                     <form method="POST" action="
                {{ route('studentbatchallocation.destroy', $exmbatch_value->id) }}">

                                        {{ csrf_field() }}
                                        @method('DELETE')


                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger delete">
                                     <i class="fas fa-trash-alt"></i>


                                 </button>
                                    &nbsp; &nbsp;<br><br>


                                     </form>

                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Exam Name</th>
                                    <th>Batch Name</th>
                                    <th>Student Name</th>
                                    <th>Student Subject</th>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script type="text/javascript">
            // window.onload = ()=> {
            // 	var del = document.querySelectorAll(".delete");
            // 	del.forEach(function(item, index){
            // 		item.onclick = ()=> {
            // 			if (confirm("Are you sure you want to delete !")) {
            // 				return true;
            // 			} else {
            // 				return false;
            // 			}
            // 		}
            // 	});
            // }
        </script>


    @endpush
@endonce
