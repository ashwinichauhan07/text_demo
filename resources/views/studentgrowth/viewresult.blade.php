@extends('layouts.admin')

@section('title', 'Keyboard Practises')

@section('sidebar')

    @parent

@endsection

@section('content')

    <style type="text/css">
        .bluebox {
            height: 60PX;
            width: 85%;
            margin: 20px;
            color: white;
            font-weight: 600;
            background-color: gray;
            text-align: center;
            padding: 10px 10px 10px 10px;
            border-radius: 5px;
            font-size: 30px;


        }

        .box {
            background-color: #2e2e1f;
            color: white;
            height: 50px;
            width: 25%;
            text-align: center;
            display: inline-block;
            padding: 4px 4px 4px 4px;
            margin-bottom: 2%;
            margin-left: 3%;
            border-radius: 5px;
            font-size: 20px;
            padding-left: 1.5em;

        }

        /*   .passage{*/

        /*    width: 100%;*/


        /*   }*/

        /*   .passage h2{*/
        /*    background-color: gray;*/
        /*    text-align: center;*/
        /*    padding-top: 20px;*/
        /*    padding-bottom: 20px;*/
        /*    font-weight: bold;*/
        /*    font-size: 30px;*/
        /*    height: 80px;*/
        /*    border-radius: 5px;*/
        /*    margin-bottom: 10px;*/
        /*    margin-top: 390px;*/


        /*   }*/
        /*.speedpassage{*/
        /*    width: 100%;*/

        /*}*/
        /*   .speedpassage button{*/

        /*    background-color: black;*/
        /*    color: white;*/
        /*    margin-right: 40px;*/
        /*    padding-top: 20px;*/
        /*    padding-bottom: 20px;*/
        /*    width: 300px;*/
        /*    float: left;*/
        /*    text-align: center;*/
        /*    margin-left: 40px;*/
        /*    margin-top: 30px;*/
        /*    margin-bottom: 30px;*/
        /*    border-radius: 5px;*/

        /*   }*/


        /*   .keyboard button{*/

        /*    background-color: black;*/
        /*    color: white;*/
        /*    border-radius: 5px;*/
        /*    margin-right: 40px;*/
        /*    margin-left: 40px;*/
        /*    padding-top: 20px;*/
        /*    padding-bottom: 20px;*/
        /*    width: 300px;*/
        /*    text-align: center;*/
        /*    float: left;*/
        /*    margin-top: 30px;*/
        /*    margin-bottom: 30px;*/

        /*   }*/

    </style>


    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mt-4 ml-4 mr-10">
                <li class="breadcrumb-item active"><b style="font-size:20px;">{{ $student_id->user->name }}  {{ $student_id->father_name }}
                    {{ $student_id->lastname }}</b></li>

                <a class="btn btn-dark" style="margin-left: 45em; "
                   href="{{ route('studentgrowth.index')}}">Back</a>
            </ol>
            <div>
                @foreach($student as $key=>$stud_value)

                    <div class="bluebox"><h2>
                            Practise {{ $stud_value->subject->name }}</h2></div>

                    @foreach($practise_types as $key=>$practise_type_value)
                        @if($practise_type_value->practise_type == 1)
                            @if($stud_value->subject->id == $practise_type_value->subject_id)
                                <div class="box">


                                    {{--                                        {{ $practise_type_value->name }}--}}

                                    <form method="post"
                                          action="{{ route('studentgrowth.viewenglishresult')}}">
                                        @csrf
                                        <input type="text" name="user_id" value="{{ $id }}" hidden>


                                        <input type="text" name="practise_id" value="{{ $practise_type_value->id }}"
                                               hidden>


                                        <button type="Submit">{{ $practise_type_value->name }}</button>


                                    </form>

                                </div>
                            @endif
                        @endif


                    @endforeach

                    @foreach($practise_types as $key=>$practise_type_value)

                        @if($practise_type_value->practise_type == 0)
                            @if($stud_value->subject->id == $practise_type_value->subject_id)


                                <div class="box">

                                    <form method="post"
                                          action="{{ route('studentgrowth.test') }}">
                                        @csrf
                                        <input type="text" name="user_id" value="{{ $id }}" hidden>

                                        <input type="text" name="practise_type_id"
                                               value="{{ $practise_type_value->id }}" hidden>

                                        <button type="Submit">
                                            {{ $practise_type_value->name }}
                                        </button>


                                    </form>

                                <!--  <a href="{{ route('studentgrowth.test',
                                        $practise_type_value->id)}}" >
                                    {{ $practise_type_value->name }}

                                    </a>  -->
                                </div>




                            @endif
                        @endif

                    @endforeach
                @endforeach

            </div>


            <div class="bluebox">
                <h2>
               Practise MCQ Question
                </h2>

            </div>

            @foreach($mcqtype as $key=>$mcqtype_value)

            <div class="box">

                <form method="post"
                action="{{ route('studentgrowth.mcq_practiseresult')}}">
              @csrf
              <input type="text" name="user_id" value="{{ $id }}" hidden>


              <input type="text" name="mcqtype_id" value="{{ $mcqtype_value->id }}"
                     hidden>


              <button type="Submit">{{ $mcqtype_value->name }}</button>


          </form>

      {{--  </div>  --}}

            </div>


            @endforeach

            @foreach($student as $key=>$stud_value)

                    <div class="bluebox"><h2>
                            Test {{ $stud_value->subject->name }}</h2></div>

                    @foreach($practise_types as $key=>$practise_type_value)
                        @if($practise_type_value->practise_type == 1)
                            @if($stud_value->subject->id == $practise_type_value->subject_id)
                                <div class="box">


                                    {{--                                        {{ $practise_type_value->name }}--}}

                                    <form method="post"
                                          action="{{ route('studentgrowth.testresult')}}">
                                        @csrf
                                        <input type="text" name="user_id" value="{{ $id }}" hidden>


                                        <input type="text" name="practise_id" value="{{ $practise_type_value->id }}"
                                               hidden>


                                        <button type="Submit">{{ $practise_type_value->name }}</button>


                                    </form>

                                </div>
                            @endif
                        @endif


                    @endforeach


                    @endforeach


            <div class="bluebox">
                <h2>
               Test MCQ Question
                </h2>
            </div>

            @foreach($mcqtype as $key=>$mcqtype_value)

            <div class="box">

                <form method="post"
                action="{{ route('studentgrowth.mcq_testresult')}}">
              @csrf
              <input type="text" name="user_id" value="{{ $id }}" hidden>


              <input type="text" name="mcqtype_id" value="{{ $mcqtype_value->id }}"
                     hidden>


              <button type="Submit">{{ $mcqtype_value->name }}</button>

          </form>

      {{--  </div>  --}}

            </div>


            @endforeach

            <div class="bluebox" width="100%" >
                <h2>
               Installment Details
                </h2>
            </div>
            <div class="col-xl-12">
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="95%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Date </th>
                            <th>Student Name</th>
                            <th>Cash/Check/Online</th>
                            <th>Check Number/Transaction ID</th>
                            <th>Check Date</th>
                            <th>Amount Paid</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                      <tbody>@php $page =0; @endphp
                        @foreach($studentinstallment as $installment_value)
                         <tr>
                             <td>{{ $installment_value->installment_date }}</td>
                             <td>{{ $installment_value->student->user->name }}</td>
                             <td>
                                 @if($installment_value->mode == 1)
                                 Cash
                                 @elseif($installment_value->mode == 2)
                                 Check
                                 @else
                                 Online
                                 @endif
                                </td>
                             <td>
                                @if($installment_value->mode == 2)
                               {{ $installment_value->check_number }}
                                @elseif($installment_value->mode == 3)
                                {{ $installment_value->transaction_id }}
                                @endif

                             <td>{{ $installment_value->check_date }}</td>
                             <td>{{ $installment_value->amount }}</td>
                             <td><a href="{{ route('installment.receipt',$installment_value->id) }}" class="btn btn-dark" target="_blank">Print</a></td>
                         </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Date </th>
                                <th>Student Name</th>
                                <th>Cash/Check/Online</th>
                                <th>Check Number</th>
                                <th>Check Date</th>
                            <th class="table-success">Total {{ $total_amount }}</th>
                                <th>Print</th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>

            <div class="bluebox" width="100%" >
                <h2>
               Attendense Details
                </h2>
            </div>
            <div class="col-xl-12">
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="95%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Date </th>
                            <th>Batch</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Time Given</th>
                        </tr>
                    </thead>
                      <tbody>@php $page =0; @endphp
                        @foreach($student_session as $student_value)
                         <tr>
                             <td>{{ $student_value->date }}</td>
                             <td>{{ $student_value->itiming->start_time }} to {{ $student_value->itiming->end_time }}</td>
                             <td>{{ $student_value->in_time }}</td>
                             <td>{{ $student_value->out_time }}</td>
                             <td>
                                 @php
                                 $i = explode(":",$student_value->in_time);
                                 $o =  explode(":",$student_value->out_time);

                                 $outtime = $o[0].$o[1].".".$o[2];
                                 $intime = $i[0].$i[1].".".$i[2];

                                 $sub =(int)$outtime - (int)$intime;

                                 @endphp
                                 {{ $sub }} Min
                             </td>

                         </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Date </th>
                                <th>Batch</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Time Given</th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>






        </div>
    </main>

    {{--    <main>--}}
    {{--        <div class="container-fluid"><br><br>--}}

    {{--            <div>--}}
    {{--                @foreach($student as $key=>$stud_value)--}}

    {{--                    <div class="passage"><h2>--}}
    {{--                            {{ $stud_value->subject->name }}</h2></div>--}}

    {{--                    @foreach($practise_types as $key=>$practise_type_value)--}}

    {{--                        @if($practise_type_value->practise_type == 1)--}}
    {{--                            @if($stud_value->subject->id == $practise_type_value->subject_id)--}}


    {{--                                <div class="speedpassage">--}}
    {{--                                <!-- <button>--}}
    {{--                                    {{ $practise_type_value->name }}--}}

    {{--                                    </button> -->--}}
    {{--                                    <form method="post"--}}
    {{--                                          action="{{ route('studentgrowth.viewenglishresult')}}">--}}
    {{--                                        @csrf--}}
    {{--                                        <input type="text" name="user_id" value="{{ $id }}" hidden>--}}


    {{--                                        <input type="text" name="practise_id" value="{{ $practise_type_value->id }}"--}}
    {{--                                               hidden>--}}


    {{--                                        <button type="Submit">{{ $practise_type_value->name }}</button>--}}

    {{--                                    <!-- <a href="{{ route('studentgrowth.viewenglishresult',--}}
    {{--                                        $practise_type_value->id)}}" >--}}
    {{--                                    {{ $practise_type_value->name }}--}}
    {{--                                        </a>--}}
    {{---->--}}

    {{--                                    </form>--}}
    {{--                                </div>--}}


    {{--                            @endif--}}
    {{--                        @endif--}}

    {{--                    @endforeach--}}

    {{--                    @foreach($practise_types as $key=>$practise_type_value)--}}

    {{--                        @if($practise_type_value->practise_type == 0)--}}
    {{--                            @if($stud_value->subject->id == $practise_type_value->subject_id)--}}


    {{--                                <div class="keyboard">--}}

    {{--                                    <form method="post"--}}
    {{--                                          action="{{ route('studentgrowth.test') }}">--}}
    {{--                                        @csrf--}}
    {{--                                        <input type="text" name="user_id" value="{{ $id }}" hidden>--}}

    {{--                                        <input type="text" name="practise_type_id"--}}
    {{--                                               value="{{ $practise_type_value->id }}" hidden>--}}

    {{--                                        <button type="Submit">--}}
    {{--                                            {{ $practise_type_value->name }}--}}
    {{--                                        </button>--}}


    {{--                                    </form>--}}

    {{--                                <!--  <a href="{{ route('studentgrowth.test',--}}
    {{--                                        $practise_type_value->id)}}" >--}}
    {{--                                    {{ $practise_type_value->name }}--}}

    {{--                                    </a>  -->--}}
    {{--                                </div>--}}




    {{--                            @endif--}}
    {{--                        @endif--}}

    {{--                    @endforeach--}}

    {{--                @endforeach--}}


    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </main>--}}

@endsection

@once
    @push('scripts')
        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script type="text/javascript">
            window.onload = () => {
                var del = document.querySelectorAll(".delete");
                del.forEach(function (item, index) {
                    item.onclick = () => {
                        if (comfirm("Are you sure you want to delete it!")) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                });
            }

            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>

    @endpush
@endonce

