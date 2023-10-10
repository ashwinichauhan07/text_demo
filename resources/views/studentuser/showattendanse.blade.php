@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid"><br><br>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1">
                    Attendance
</i>

                </div>
                <div class="col-xl-12">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Batch</th>
                                    <th>Attendance</th>
                                </tr>
                                </thead>
                                @php $page =0; @endphp
                                <tbody>
                                @foreach($attendanse_data as $key => $paid_value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $paid_value->created_at }}</td>
                                        <td>{{ $paid_value->itiming->start_time }} to {{ $paid_value->itiming->end_time }}</td>
                                        <td><strong class="text-success">Present</strong></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Batch</th>
                                    <th>Attendance</th>
                                </tr>

                                </tfoot>

                            </table>

                            <a class="btn btn-dark" href="{{ url()->previous() }}" class="btn btn-default"> <i class="fas fa-arrow-circle-left" style="font-size: 25px;"></i></a>
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
        <script src="{{ url('public/chartJs/chart-bar-demo.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script src="{{ url('public/js/a.js') }}"></script>

    @endpush
@endonce
