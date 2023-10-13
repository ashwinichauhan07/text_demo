@extends('layouts.demo')

@section('title', 'Page Exam Batch')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Exam Batches List </i>
                    <a href="{{ route('examBatches.create') }}" class="btn btn-dark float-right">Create Exam Batches</a>
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
                <th>Exam Date</th>
                <th>Subject</th>
                <th>Exam Name</th>
                <th>Batch Number</th>
                <th>Batch Start Time</th>
                <th>Batch End Time</th>
                <th>Center Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($exmBatch as $key => $exmBatch_value)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $exmBatch_value->exam_date }}
                      ({{ $exmBatch_value->day }})

                </td>
                <td>{{ $exmBatch_value->subject->name }}</td>
                <td>{{ $exmBatch_value->eammname->name }}</td>
                <td>{{ $exmBatch_value->batch_number }}</td>
                <td><input type="time"value="{{ $exmBatch_value->start_time }}" disabled></td>
                 <td><input type="time"value="{{ $exmBatch_value->end_time }}" disabled></td>
                <td>{{ auth()->user()->name }}</td>
                <td>
                <form action="{{ route('examBatches.destroy', $exmBatch_value->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                <a href="{{ route('examBatches.edit',[ $exmBatch_value->id ]) }}" class="btn btn-primary edit"><i class="fas fa-edit"></i></a>
                <br>
                <br>
               <button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>
               </form>
           </td>

            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
               <th>#</th>
                <th>Exam Date</th>
                <th>Subject</th>
                <th>Exam Name</th>
                <th>Batch Number</th>
                <th>Batch Start Time</th>
                <th>Batch End Time</th>
                <th>Center Name</th>
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


    @endpush
@endonce
