@extends('layouts.admin')

@section('title', 'Page homekey')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Student Type </i>
                    <a href="{{ route('studentType.create') }}" class="btn btn-dark float-right">Add Student Type</a>
            </div>
            <div class="col-xl-12">
                <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>created_at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($studentType as $key => $student_value)
                        <tr>

                         <td>{{ $key++ }}</td>
                         <td>{{ $student_value->name}}</td>
                         <td>{{ $student_value->created_at}}</td>
                         <td>
                             <form method="POST" action="{{ route('studentType.destroy',[ $student_value->id ]) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <span class="glyphicon glyphicon-trash"></span>

                        <button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>

                            </form>
                         </td>

                         </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>created_at</th>
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
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

        <script src="{{ url('public/js/jquery-3.5.1.slim.min.js') }}"></script>  --}}

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

        <script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

    @endpush
@endonce
