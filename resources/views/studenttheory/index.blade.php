@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')
<style>
  h1
  {
    text-align: center;
    font-size: 30px;
    font-weight: 600;
    background-color: gray;
    width: 100%;
  }
 .box{
      background-color:#2e2e1f;
      color: white;
      height: 50px;
      width: 50%;
      text-align: center;
      display: inline-block;
      margin-bottom: 2%;
      margin-left:3%;
      border-radius: 5px;
      font-size: 20px;
      padding-left: 1.5em;
      padding-right: 5em;
      margin-top: 30px;

    }


#currentTime {
  font-size: 2em;
  font-family: 'Oswald';
  font-weight: 300;
  color: #f05b19;
}
</style>

 <main>
                    <div class="container-fluid">

                       <br><br>

                            <div class="card-header">


                                <h2 id="currentTime"></h2>


                            </a>
                            </div>

                            <!-- <div class="col-xl-12"> -->

                                    <div class="card-body">
                                    <h1>Theory</h1>
{{--                                    <select class="box" onchange="location = this.value;">--}}
{{--                                    <option selected>Select Multiple Choice Questions (MCQ) Type...</option>--}}
{{--                                    <option>MS-WORD</option>--}}
{{--                                    <option>MS-EXCEL</option>--}}
{{--                                    <option>MS-POWER POINT</option>--}}
{{--                                    <option>COMPUTER FUNDAMENTALS & OS</option>--}}
{{--                                    <option>INTERNET</option>--}}
{{--                                    <option>QUESTIONS BANK AND PRACTICES</option>--}}
{{--                                  </select>--}}
{{--                                        <form action="{{ route('studenttheory.test') }}">--}}

                                        <select class="box"  onchange="location = this.value;">
                                            <option value="" name="test_id" >Select Multiple Choice Questions (MCQ) Type...</option>

                                            @foreach($practiseExam as $key => $practise_value)

                                                <option value="{{ route('studenttheory.test',$practise_value->id) }}">
                                                    {{ $practise_value->name }}
                                                </option>

                                            @endforeach

                                        </select>
{{--                                        </form>--}}

                                       </div>
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

         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

         <script src="{{ url('public/js/a.js') }}"></script>


        {{-- <script> --}}
        {{--    window.onload =()=> {--}}

        {{--        var test_id = document.getElementById('test_id');--}}

        {{--        test_id.onchange = () => {--}}
        {{--            console.log(test_id.value);--}}
        {{--            // console.log(course_id);--}}
        {{--            // console.log(student.value);--}}
        {{--            var formData = new FormData--}}
        {{--            formData.append("_token", document.querySelector('meta[name="csrf-token"]').content);--}}
        {{--            formData.append("test_id", test_id.value);--}}
        {{--            // console.log(student_type.value);--}}
        {{--            var xhttp = new XMLHttpRequest();--}}
        {{--            xhttp.onreadystatechange = function () {--}}
        {{--                if (this.readyState == 4 && this.status == 200) {--}}
        {{--                    // console.log(this.responseText);--}}
        {{--                    var response = JSON.parse(this.responseText);--}}
        {{--                    // console.log(response.status);--}}
        {{--                    if (response.status) {--}}

        {{--                    }--}}
        {{--                }--}}
        {{--            };--}}

        {{--            xhttp.open("POST", "{{ route('studenttheory.test') }}", true);--}}
        {{--            xhttp.send(formData);--}}
        {{--        }--}}
        {{--    }--}}

        {{-- </script> --}}

        <script>

window.onload = function() {
  clock();
    function clock() {
    var now = new Date();
    var TwentyFourHour = now.getHours();
    var hour = now.getHours();
    var min = now.getMinutes();
    var sec = now.getSeconds();
    var mid = 'PM';
    var session_time = 'SESSION TIME';
    if (min < 10) {
      min = "0" + min;
    }
    if (hour > 12) {
      hour = hour - 12;
    }
    if(hour==0){
      hour=12;
    }
    if(TwentyFourHour < 12) {
       mid = 'Am';
    }
  document.getElementById('currentTime').innerHTML =     session_time + ":-" + hour+':'+min+':'+sec +' '+mid ;
    setTimeout(clock, 1000);
    }
}

        </script>



    @endpush
@endonce
