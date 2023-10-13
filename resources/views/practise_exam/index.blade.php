@extends('layouts.admin')

@section('title', 'Exam')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                      <!-- Show Message -->
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

                        <div class="row mt-4">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                </div>
                            </div>

                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"> Exam List </i>



                                <a href="{{ route('practise_exam.create') }}" class="btn btn-dark float-right">Add Exam</a>


                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
{{--                                                <th>Code</th>--}}
                                                <th>Name</th>

                                                <th>Created</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($examData as $key => $subject_expert_value)
                                            <tr>
                                                <td>{{ $key += 1 }}</td>
                                                {{--                                                <td>{{ $subject_expert_value->code }}</td>--}}
                                                <td>{{ $subject_expert_value->name }}</td>

                                                <td>{{ $subject_expert_value->created_at }}</td>

                                                <td>
                                                    <form method="POST" action="{{ route('practise_exam.destroy',[$subject_expert_value->id]) }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class=""><i class="fas fa-trash" style="font-size:24px;color:red;"></i></button>
                                                    </form>

                                                    {{--                                                    <a href="{{ route('practise_exam_conductor.edit',[$subject_expert_value->id]) }}">--}}
                                                    {{--                                                      <i class="fas fa-eye-dropper" style="font-size:24px;color:SteelBlue;"></i>--}}
                                                    {{--                                                    </a>--}}


                                                    <a href="{{ route('practise_exam.show',[$subject_expert_value->id]) }}">
                                                        <i class="fas fa-eye" style="font-size:24px;color:green;"></i>
                                                    </a>




                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
{{--                                                <th>Code</th>--}}
                                                <th>Name</th>

                                                <th>Created</th>
                                                <th>Action</th>

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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>


    @endpush
@endonce
