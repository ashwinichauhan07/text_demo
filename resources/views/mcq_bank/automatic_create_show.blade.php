@extends('layouts.admin')

@section('title', 'Question List Preview')

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
                        <strong>Question List Preview</strong>
                    </p>
                </div>

                <div class="card mb-4">
                    <div class="card-body">

                        @foreach($questionData as $key => $que_value)
                        <!-- Question cards -->
                        <div class="card mt-4">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-1">
                                        <strong class="text-success">Q.</strong>
                                    </div>
                                    <div class="col-6">
                                        {!! $que_value->que !!}
                                        {{--                                                        {!! $que_value->quemarathi !!}--}}

                                        {{--                                                        {!! $que_value->quehindi !!}--}}
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

                        <form method="POST" action="{{ route('mcq_bank.automatic_store') }}">

                            @csrf

                            <input type="hidden" name="subject_id" value="{{ $data['subject_id'] }}">

                            <input type="hidden" name="mcq_type_id" value="{{ $data['mcq_type_id'] }}">

                            <input type="hidden" name="total_writing_question"
                                value="{{ $data['total_writing_question'] }}">

                            <input type="hidden" name="total_mcq_question" value="{{ $data['total_mcq_question'] }}">

                            {{--                                            <input type="hidden" name="each_writing_mark" value="{{ $data['each_writing_mark'] }}">--}}

                            {{--                                            <input type="hidden" name="each_mcq_mark" value="{{ $data['each_mcq_mark'] }}">--}}

                            {{--                                            <input type="hidden" name="each_negative_writing_mark" value="{{ $data['each_negative_writing_mark'] }}">--}}

                            {{--                                            <input type="hidden" name="each_negative_mcq_mark" value="{{ $data['each_negative_mcq_mark'] }}">--}}

                            <!-- {{--                                            <input type="hidden" name="required_time" value="{{ $data['required_time'] }}">--}} -->

                            <input type="hidden" name="questionPaperName" value="{{ $data['questionPaperName'] }}">

                            <select name="question[]" multiple style="display: none;">

                                @foreach($questionData as $key => $que_value)
                                <option value="{{ $que_value->id }}" selected></option>
                                @endforeach
                            </select>



                            <p class="text-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg">continue</button>
                            </p>



                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>


@endsection

@once
@push('scripts')

@endpush
@endonce