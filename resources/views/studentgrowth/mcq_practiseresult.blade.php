@extends('layouts.admin')

@section('title', 'Keyboard Practises')

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
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <b style="font-size:20px;">{{$studentuser_id->user->name}} {{$studentuser_id->father_name }} {{$studentuser_id->lastname }}</li></b>
                        </ol>

                        <div class="row mt-4">

                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"> Answer Sheet </i>


                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h1 class="alert alert-success text-center text-capitalize">{{ $mcqtype->name }}</h1>

                                    @foreach($answerSheetData as $key => $sheet_value)
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-1">
                                                        <strong class="text-success">Q.</strong>
                                                    </div>
                                                    <div class="col-6">
                                                        {!! $sheet_value->question->que !!}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-1">
                                                        <strong class="text-primary">Ans.</strong>
                                                    </div>
                                                    <div class="col-6">
                                                        @if(isset($sheet_value->answer->ans))
                                                            {!! $sheet_value->answer->ans !!}
                                                        @else
                                                            {{ $sheet_value->ans }}
                                                        @endif

                                                        @if($sheet_value->question->ans_right->id == $sheet_value->answer_id)
                                                                <i class="fas fa-check-circle" style="color: #00e676;"></i>
                                                        @else
                                                                <i class="fas fa-question-circle" style="color: #c82333;" title="System unable to check this question."></i>
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                    <br>

                                    <div class="card mt-1">
                                        <div class="card-body">
                                            <p>
                                                Total Question :- <i id="to_mark">{{ $total_que }}</i>
                                            </p>

                                            <p>Total Solved Question :- <i id="ma_obtained">{{$m_w_a}}</i></p>

                                            <p>Accuracy :- <i id="par_obtained">{{ $accuracy }} %</i>

                                            </p>
                                            <br>

                            </div>
                        </div>
                    </div>
                </main>




@endsection

@once
    @push('scripts')
    	<script>

            window.onload = ()=> {
                var to_mark = document.getElementById('to_mark');
                var total_mark = document.getElementById("total_mark");
                total_mark.value = to_mark.innerHTML;

                var ma_obtained = document.getElementById("ma_obtained");
                var mark_obtained = document.getElementById("mark_obtained");
                mark_obtained.value = ma_obtained.innerHTML;

                var par_obtained = document.getElementById("par_obtained");
                var percentage_obtained = document.getElementById("percentage_obtained");
                percentage_obtained.value = par_obtained.innerHTML;

                var res = document.getElementById("res");
                var result = document.getElementById("result");
                result.value = res.innerHTML;
            }

        </script>
    @endpush
@endonce
