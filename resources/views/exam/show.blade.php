@extends('layouts.demo')

@section('title', 'Exam Details')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Exam Details
                                 <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('exam.index')}}">Back</a>
                            </li>
                        </ol>

                        <!-- Show Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Show Message -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row mt-4">

                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-body">

                                        <form action="{{ route('institute.store') }}" method="POST">
                                          {{ csrf_field() }}

                                          <input type="hidden" name="userType" value="2">


                                        <div class="row">



                                          <div class="form-group col-6">

                                            <label for="instituteName">Exam Name</label>
                                            <p class="alert alert-success">
                                                {{ $exam->examname->name }}</p>

                                          </div>


                                          <div class="form-group col-6">

                                            <label for="instituteEmail1">Batch Name</label>

                                <p class="alert alert-success">{{ $exam->exam_batche->batch_number }}</p>

                                          </div>


                                          <div class="form-group col-6">

                                            <label for="instituteName">Start Exam</label>
                                            <p class="alert alert-success">{{ $exam->startExam }}</p>

                                          </div>


                                          <div class="form-group col-6">

                                            <label for="instituteName">End Exam</label>
                                            <p class="alert alert-success">{{ $exam->endExam }}</p>

                                          </div>


                                          <div class="form-group col-6">

                                            <label for="instituteName">Duration</label>
                                            <p class="alert alert-success">{{ $exam->duration }}</p>

                                          </div>


                                          <div class="form-group col-6">

                                            <label for="instituteName">Instruction Time</label>
                                            <p class="alert alert-success">{{ $exam->instruction_time }}</p>

                                          </div>


                                          <div class="form-group col-6">

                                            <label for="instituteName">Pass percentage</label>
                                            <p class="alert alert-success">{{ $exam->pass_percentage }}</p>

                                          </div>



                                          {{--  <div class="form-group col-6">

                                            <label for="instituteName">Show Result After Exam</label>
                                            <p class="alert alert-success">{{ ($exam->result == 1 ? "Yes" : "No") }}</p>

                                          </div>  --}}


                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>

                    <!-- studnet list -->
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Exam Student List</li>
                        </ol>

                        <div class="card">
                            <div class="card-body">

                                @foreach($exam->student as $key => $stu_value)
                                    <div class="card mt-1">
                                        <div class="card-body bg-secondary">
                                            {{ $stu_value->user->name }}
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                    </div>
                </main>




@endsection

@once
    @push('scripts')
    	{{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/datatables-demo.js') }}"></script>
        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    @endpush
@endonce
