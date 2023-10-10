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
</style>

 <main>
                    <div class="container-fluid">

                       <br><br>

{{--                            <div class="card-header">--}}
{{--                                SESSION :---}}
{{--                                {{ auth()->user()->student->isession->month->month_name }} to--}}
{{--                                {{ auth()->user()->student->isession->monthname->month_name }}--}}
{{--                                </a>--}}
{{--                            </div>--}}

                            <!-- <div class="col-xl-12"> -->

                                    <div class="card-body">
                                    <h1>Theory Test</h1>


                                        <select class="box"  onchange="location = this.value;">
                                            <option value="" name="test_id" >Select MCQ Test</option>

                                            @foreach($practiseExam as $key => $practise_value)

                                                <option value="{{ route('student_theorytest.test',$practise_value->id) }}">
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
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>  --}}

       


         <script src="{{ url('public/js/a.js') }}"></script>


        <script>
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

        {{--</script>--}}

    @endpush
@endonce
