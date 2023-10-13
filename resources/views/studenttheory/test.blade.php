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
        <p class="text-center mt-5" id="showTime"></p>
        <div class="row">
                <div class="col-md-12" id="upcoming_exam">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="text-center">
                                <strong>Practise Type {{ $examData->name }}</strong>
                            </h5>
{{--                            @foreach($examData as $key => $exam_value)--}}
                                <div class="row mt">
                                    {{-- <div class="col-md-12 text-center">
                                        <strong>Practise Type :</strong>
                                        <p>{{ $examData->name }}</p> --}}
                                    </div>
                                    {{-- <div class="col-md-3 text-center">
                                        <strong>Subject Name :</strong>
                                        <p>{{ $examData->name }}</p>
                                    </div> --}}

                                </div>
{{--                            @endforeach--}}

                            <form method="POST" action="{{ route('studenttheory.starttest') }}">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{ $examData->id }}">
                                <div class="text-center" style="margin-bottom: 1pem;">
                                    <button class="btn btn-dark" id="examStartBtn">START PRACTICE</button>
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
