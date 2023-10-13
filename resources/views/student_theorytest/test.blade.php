<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('status'))
    <div class="alert alert-danger m-4">
        {{ session('status') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-danger m-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="container-fluid">
        <p class="text-center mt-4" id="showTime"></p>
        <div class="row">
            <div class="col-md-12" id="upcoming_exam">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="text-center">
                            <strong>Practise {{ $examData->name }} Test</strong>
                        </h5>
                        {{--                            @foreach($examData as $key => $exam_value)--}}
                        <div class="row mt-4">
                            <div class="col-md-3 text-center">
                                <strong>Test Name :</strong>
                                <p>{{ $examData->name }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <strong>Subject Name :</strong>
                                @if ($examData->question_bank)
                                <p>{{ $examData->question_bank->subject->name }}</p>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <p class="text-center">

                                    <strong>Duration :</strong>: @php

                                    echo $timediff->format('%h hour %i minute %s second')."<br />";
                                    @endphp

                                </p>
                            </div>

                        </div>
                        {{--                            @endforeach--}}

                        <form method="POST" action="{{ route('student_theorytest.starttheorytest') }}">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{ $examData->id }}">

                            <input type="hidden" name="min" value="{{ date("i") }}">
                            <div class="text-center">
                                <input type="submit" name="test" value="START TEST" class="btn btn-dark">

                                {{--                                    <button class="btn btn-dark" id="examStartBtn" value="TEST">START PRACTICE</button>--}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            {{--        @endif--}}




        </div>

    </div>
</x-app-layout>
<script src="{{ url('public/js/a.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

</script>


<script type="text/javascript">
// window.onload = ()=>{
//
//     setInterval(function(){
//
//         var dateAndTime = new Date();
//         var showTime = document.getElementById("showTime");
//         showTime.innerHTML = dateAndTime;
//
//         startExam();
//
//     }, 1000);
</script>