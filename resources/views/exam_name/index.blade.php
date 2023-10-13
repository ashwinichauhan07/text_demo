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
                <i class="fas fa-table mr-1"> Exam Name List </i>
                    <a href="{{ route('exam_name.create') }}" class="btn btn-dark float-right">Add Exam Name</a>
            </div>
            <div class="col-xl-12">
                <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif


                 @if (session('exam_status'))
                <div class="alert alert-danger">
                    {{ session('exam_status') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Exam Name</th>
                        <th>Created at</th>
<!--                         <th>Updated at</th>
 -->
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ExamData as $key => $exam_value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $exam_value->name }}</td>
                        <td>{{ $exam_value->created_at }}</td>
<!--                         <td>{{ $exam_value->updated_at }}</td>
 -->
                        <td>
                                <form method="POST" action="{{ route('exam_name.destroy',[$exam_value->id]) }}">


                                    <a class="btn btn-primary" href="{{ route('exam_name.edit',$exam_value->id) }}">
                                        <i class="fas fa-edit"></i></a>

                                        {{ csrf_field() }}
                                        @method('DELETE')
                                    <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>
                                        &nbsp; &nbsp;<br><br>
                                    </form>


                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sr.No</th>
                        <th>Exam Name</th>
                        <th>Created at</th>
<!--                         <th>Updated at</th>
 -->
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
