@extends('layouts.admin')

@section('title', 'Question Bank Gate')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">



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

                                <div class="alert alert-success">
                                <p class="text-center">
                                    <strong>Question Paper ({{ $mcq_bank->questionPaperName }}) </strong>
                                </p>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Subject :</strong> {{ $mcq_bank->subject->name }}

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Level :</strong> {{ $mcq_bank->mcqtype->name }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Writing Quesetion :</strong> {{ $mcq_bank->total_writing_question }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>MCQ Quesetion :</strong> {{ $mcq_bank->total_mcq_question }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Each Writing Q Mark:</strong> {{ $mcq_bank->each_writing_mark }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Each Mcq Q Mark:</strong> {{ $mcq_bank->each_mcq_mark }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Writing Neg Mark:</strong> {{ $mcq_bank->each_negative_writing_mark }}
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-3 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>MCQ Neg Mark:</strong> {{ $mcq_bank->each_negative_mcq_mark }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Total Question:</strong> {{ count($questionData) }}
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-4 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Required Time:</strong> {{ $mcq_bank->required_time }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <strong>Created By:</strong> {{ $mcq_bank->user->name }}
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>

                                <div class="card mb-4">

                                    <div class="alert alert-success">
                                        <p class="text-center">
                                            <strong>Question List </strong>
                                        </p>
                                    </div>

                                    <div class="card-body">

                                        @foreach($questionData as $key => $que_value)
                                        <!-- Question cards -->
                                        <div class="card mt-4" style="background-color: #D2D1CD">
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-1">
                                                        <strong class="text-success">Q.</strong>
                                                    </div>
                                                    <div class="col-6">
                                                        {!! $que_value->que !!}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-1">
                                                        <strong class="text-primary">Ans.</strong>
                                                    </div>
                                                    <div class="col-6">
                                                        {!! $que_value->ans_right->ans !!}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-1">
                                                        <strong class="text-info">Exp.</strong>
                                                    </div>
                                                    <div class="col-6">
                                                        {!! $que_value->explanation !!}
                                                    </div>
                                                </div>

                                                @if($que_value->is_mcq == 1)

                                                <p class="text-center"><strong>MCQ</strong></p>



                                                <div class="row mt-4">
                                                    @foreach($que_value->answer as $key => $ans_value)

                                                    <div class="col-3">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <p class="text-center">{!! $ans_value->ans !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @endforeach
                                                </div>


                                                @endif

                                            </div>
                                        </div>
                                        @endforeach


                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </main>




@endsection

@once
    @push('scripts')

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


    @endpush
@endonce
