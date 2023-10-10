@extends('layouts.admin')

@section('title', 'McqQuestion')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <b style="font-size:20px;">{{$studentuser_id->user->name}} {{$studentuser_id->father_name }} {{$studentuser_id->lastname }}</li></b>
                        </ol>
        <div class="row mt-4"></div>
        <div class="card mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Exam Name</th>
                                <th>MCQ Type</th>
                                <th>Total Mark</th>
                                <th>Obtain Mark</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($mcqtestexam as $key => $ans_value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $ans_value->name }}</td>
                                <td>{{ $ans_value->question_bank->mcqtype->name }}</td>
                                <td>{{ $ans_value->totalmark }}</td>
                                <td>{{ $ans_value->mark_obtain }}</td>

                            </tr>

                            @endforeach

                        </tbody>
                       <tfoot>
                          <tr>
                            <th>Sr.No</th>
                                <th>Exam Name</th>
                                <th>MCQ Type</th>
                                <th>Total Mark</th>
                                <th>Obtain Mark</th>
                            </tr>
                       </tfoot>
                    </table>
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
        <!-- -<script src="{{ url('chartJs/chart-area-demo.js') }}"></script> -->
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script> -
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>




    @endpush
@endonce
