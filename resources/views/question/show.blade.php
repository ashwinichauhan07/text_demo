@extends('layouts.demo')

@section('title', 'Question Details')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Question Details <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('question.index') }}">Back</a> </li>
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


                                        <div class="card">
                                          <div class="card-body">

                                            {{--  <strong>Subject</strong> : {{ $question->subject->name }} &emsp;&emsp; &emsp;&emsp;  --}}

                                            {{--  <strong>MCQ Type</strong> : {{ $question->mcqtypes->name }} &emsp;&emsp; &emsp;&emsp;  --}}

                                            <strong>Is Mcq</strong> : {{ $question->is_mcq == 1 ? "Yes" : "No" }} &emsp;&emsp;  &emsp;&emsp;

                                            <strong>Use Count</strong> : {{ $question->view == null ? "0" : $question->view }} &emsp;&emsp;  &emsp;&emsp;

                                            <strong>Added By</strong> : {{ $question->user->name }}

                                          </div>
                                        </div>



                                        <div class="card mt-4">
                                          <div class="card-body">
                                            <h4><b>English</b></h4>
                                              <br>
                                            <div class="row">
                                                <div class="col-2">
                                                    <strong class="text-success">Question :</strong>
                                                </div>
                                                <div class="col-6">{!! $question->que !!}</div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-2">
                                                    <strong class="text-primary">Wright Answer</strong> :
                                                </div>
                                                <div class="col-6">{!! $question->ans_right->ans !!}</div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-2">
                                                    <strong class="text-info">Explanation</strong> :
                                                </div>
                                                <div class="col-6">{!! $question->explanation !!}</div>
                                            </div>

                                          </div>
                                        </div>


                                         <div class="card mt-4">
                                          <div class="card-body">
                                            <h4><b>Hindi</b></h4>
                                              <br>
                                            <div class="row">
                                                <div class="col-2">
                                                    <strong class="text-success">Question :</strong>
                                                </div>
                                                <div class="col-6">{!! $question->hindique !!}</div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-2">
                                                    <strong class="text-primary">Wright Answer</strong> :
                                                </div>
                                                <div class="col-6">{!! $question->ans_right->anshindi !!}</div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-2">
                                                    <strong class="text-info">Explanation</strong> :
                                                </div>
                                                <div class="col-6">{!! $question->hindi_explanation !!}</div>
                                            </div>

                                          </div>
                                        </div>




                                         <div class="card mt-4">
                                          <div class="card-body">
                                            <h4><b>Marathi</b></h4>
                                              <br>
                                            <div class="row">
                                                <div class="col-2">
                                                    <strong class="text-success">Question :</strong>
                                                </div>
                                                <div class="col-6">{!! $question->marathique !!}</div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-2">
                                                    <strong class="text-primary">Wright Answer</strong> :
                                                </div>
                                                <div class="col-6">{!! $question->ans_right->ansmarathi !!}</div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-2">
                                                    <strong class="text-info">Explanation</strong> :
                                                </div>
                                                <div class="col-6">{!! $question->marathi_explanation !!}</div>
                                            </div>

                                          </div>
                                        </div>




                                        @if($question->is_mcq == 1)

                                        <div class="card mt-4">
                                          <div class="card-body">

                                            <strong>Mcq Answer</strong><br><br>

                                            <div class="row">

                                                    @foreach($question->answer as $key => $que_ans_value)

                                                    <div class="form-group col-6">

                                                            Ans.<strong>{!! $que_ans_value->ans !!}</strong>

                                                    </div>

                                                    @endforeach



                                                     @foreach($question->answer as $key => $que_ans_value)

                                                    <div class="form-group col-6">

                                                            Ans.<strong>{!! $que_ans_value->anshindi !!}</strong>

                                                    </div>

                                                    @endforeach


                                                     @foreach($question->answer as $key => $que_ans_value)

                                                    <div class="form-group col-6">

                                                            Ans.<strong>{!! $que_ans_value->
                                                            ansmarathi !!}</strong>

                                                    </div>

                                                    @endforeach
                                                </div>

                                          </div>
                                        </div>

                                        @endif



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
    @endpush
@endonce
