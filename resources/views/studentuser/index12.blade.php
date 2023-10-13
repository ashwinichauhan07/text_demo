@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <input type="hidden" name="student_id" id="student_id" value="{{ auth()->user()->student->id }}">

              <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">

                                    <div class="card-body"><i class="fa fa fa-comments"></i>&nbsp;&nbsp; Notice

                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#myAnchor" rel="" id="anchor1" class="anchorLink">Check Updated Notice</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-xl-2 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Total Instructor</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body"><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp; Fees Paid
{{--                                     <label style="padding-left: 40%;"></label>--}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $paid_amount }}
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('studentuser.paidfees')}}">Paid Fees Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Attendance
                                </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('studentuser.showattendanse') }}">View Attendance</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><i class="fas fa-calendar"></i>&nbsp;&nbsp; Calender</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('instructortadmin/calender')}}">Current Month</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div> -->

                        </div>


                        <div class="">


                        @if(!$typing_result->isEmpty())

                        <div class="card-header m-4" style="background-color: #e9fae9;">
                            <b style="font-size: 25px; padding-left:12em;">Typing Practise Results</b>
                            <br>
                            <br>

                            @else

                            <div class="">



                            @endif

                        @foreach($typing_result as $key => $typingPractise_value)

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card mb-6">
                                    <div class="card-header" style="background-color: #8FBC8F;">
                                        <b style="font-size: 20px;">Result of {{ $typingPractise_value->subject->name }}</b>
                                        <h6 style="font-style: italic;">{{ $typingPractise_value->typingpractise->typingdata }}</h6>
                                    </div>
                                    <div class="card-body">
                                        Time taken :- <label>{{ $typingPractise_value->time }} Min</label><hr>
                                        Total marks :- <label>{{ $typingPractise_value->tmark }}</label><hr>
                                        No of mistakes :- <label>{{ $typingPractise_value->countmistake }}</label><hr>
                                        Marks obtained :- <label>{{ $typingPractise_value->obtmark }}</label><hr>

{{--                                        No of misssing words :- <label>{{ $typingPractise_value->countlength }}</label><hr>--}}


                                           @if($typingPractise_value->typingpractise->practise->name == "SpeedLetter30")
                                            @foreach($typing_result as $key => $letter_result)

                                                    @if($letter_result->practisetype->name == "SpeedLetter30")
                                                    @if($typingPractise_value->id == $letter_result->letter_result->typing_practise_result_id)
{{--                                                    {{ $letter_result->letter_result->typing_practise_result_id }}--}}

                                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <tr>
                                                        <th>Criteria </th>
                                                        <th>Total Marks</th>
                                                        <th>Marks Obtained</th>
                                                    </tr>
                                                        <tr>
                                                            <td>Heading</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->letter_result->head }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Reference no and Date</td>
                                                            <td>0.5</td>
                                                            <td>{{ $letter_result->letter_result->reference }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address of Recipient</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->letter_result->add }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Subject and reference</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->letter_result->sub }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Salutation</td>
                                                            <td>0.5</td>
                                                            <td>{{ $letter_result->letter_result->head }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Paraagraph</td>
                                                            <td>2</td>
                                                            <td>{{ $letter_result->letter_result->salute }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Sign your name</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->letter_result->close }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enclosure(attachment)</td>
                                                            <td>0.5</td>
                                                            <td>{{ $letter_result->letter_result->enclosure }}</td>
                                                        </tr>
                                                </table>
                                                @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        @if($typingPractise_value->typingpractise->practise->name == "SpeedStatement30")
                                            @foreach($typing_result as $key => $letter_result)
                                                @if($letter_result->practisetype->name == "SpeedStatement30")
                                                    @if($typingPractise_value->id == $letter_result->statement30_result->typing_practise_result_id)

                                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                        <tr>
                                                            <th>Criteria</th>
                                                            <th>Total Marks</th>
                                                            <th>Marks Obtained</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Heading fig. format</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statement30_result->head }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Column Headings</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statement30_result->columnhead }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cells Alignment</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statement30_result->celalign }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Column Width</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statement30_result->colwidth }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Borders</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statement30_result->border }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Correct word marks</td>
                                                            <td>5</td>
                                                            <td>{{ $letter_result->statement30_result->former }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Total Marks</td>
                                                            <td>10</td>
                                                            <td>{{ $letter_result->statement30_result->total }}</td>
                                                        </tr>

                                                    </table>

                                                @endif
                                                @endif
                                            @endforeach
                                        @endif


                                        @if($typingPractise_value->typingpractise->practise->name == "SpeedStatement40")
                                            @foreach($typing_result as $key => $letter_result)
                                                @if($letter_result->practisetype->name == "SpeedStatement40")
                                                    @if($typingPractise_value->id == $letter_result->statement40_result->typing_practise_result_id)

                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <tr>
                                                                <th>Criteria</th>
                                                                <th>Total Marks</th>
                                                                <th>Marks Obtained</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Heading fig. format</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statement40_result->headfig }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Column Headings</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statement40_result->colheading }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Cells Alignment</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statement40_result->alignment }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Column Width</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statement40_result->width }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Borders</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statement40_result->borders }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Questions</td>
                                                                <td>5</td>
                                                                <td>{{ $letter_result->statement40_result->questions }}</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Correct word marks</td>
                                                                <td>10</td>
                                                                <td>{{ $letter_result->statement40_result->marksform }}</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Total Marks</td>
                                                                <td>10</td>
                                                                <td>{{ $letter_result->statement40_result->totmark }}</td>
                                                            </tr>


                                                        </table>

                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif


                                        @if($typingPractise_value->typingpractise->practise->name == "SpeedEmail30")
                                            @foreach($typing_result as $key => $email_result)
                                                @if($email_result->practisetype->name == "SpeedEmail30")
                                                    @if($typingPractise_value->id == $email_result->email30_result->typing_practise_result_id)

                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <tr>
                                                                <th>Criteria</th>
                                                                <th>Total Marks</th>
                                                                <th>Marks Obtained</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Id</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email30_result->mailId }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Subject</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email30_result->mailSub }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Body</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email30_result->mailBody }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Attachment</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email30_result->mailSave }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Save</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email30_result->mailAtt }}</td>
                                                            </tr>
                                                        </table>

                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        @if($typingPractise_value->typingpractise->practise->name == "SpeedEmail40")
                                            @foreach($typing_result as $key => $email_result)
                                                @if($email_result->practisetype->name == "SpeedEmail40")
                                                    @if($typingPractise_value->id == $email_result->email40_result->typing_practise_result_id)

                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <tr>
                                                                <th>Criteria</th>
                                                                <th>Total Marks</th>
                                                                <th>Marks Obtained</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Email To</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailTo }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email CC</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailCc }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email BCC</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailBcc }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email Subject</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailSubject }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Body</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email40_result->EmailBody }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Attachment 1</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailAtt1 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Attachment 2</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailAtt2 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email Save</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email40_result->EmailSend }}</td>
                                                            </tr>
                                                        </table>

                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif



                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>


                        {{-- Typing Test Result --}}

                        @if(!$typing_test_result->isEmpty())

                        <div class="card-header m-4" style="background-color: #f9f4fc;">
                            {{--  <div class="card g-10 text-center" style="background-color: #aeb0b3;">
                            </div>  --}}
                            <b style="font-size: 25px; padding-left:12em;">Typing Test Results</b>
                            <div class="card-body">

                                @else

                                <div class="">
                            @endif

                        @foreach($typing_test_result as $key => $typingtest_value)
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card mb-6 center">
                                    <div class="card-header text-center" style="background-color: #798379;">
                                        <b style="font-size: 20px;">Result of {{ $typingtest_value->subject->name }}</b>
                                        <h6 style="font-style: italic;">{{ $typingtest_value->typingtest->typingdata }}</h6>
                                    </div>
                                    <div class="card-body">
                                        Time taken :- <label>{{ $typingtest_value->time }} Min</label><hr>
                                        Total marks :- <label>{{ $typingtest_value->tmark }}</label><hr>
                                        No of mistakes :- <label>{{ $typingtest_value->countmistake }}</label><hr>
                                        Marks obtained :- <label>{{ $typingtest_value->obtmark }}</label><hr>

{{--                                        No of misssing words :- <label>{{ $typingtest_value->countlength }}</label><hr>--}}
                                           @if($typingtest_value->typingtest->practise->name == "SpeedLetter30")
                                            @foreach($typing_test_result as $key => $letter_result)

                                                    @if($letter_result->practisetype->name == "SpeedLetter30")
                                                    @if($typingtest_value->id == $letter_result->letter30_result->typing_test_result_id)
{{--                                                    {{ $letter_result->letter_result->typing_test_result_id }}--}}

                                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <tr>
                                                        <th>Criteria </th>
                                                        <th>Total Marks</th>
                                                        <th>Marks Obtained</th>
                                                    </tr>
                                                        <tr>
                                                            <td>Heading</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->letter30_result->head }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Reference no and Date</td>
                                                            <td>0.5</td>
                                                            <td>{{ $letter_result->letter30_result->reference }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address of Recipient</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->letter30_result->add }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Subject and reference</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->letter30_result->sub }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Salutation</td>
                                                            <td>0.5</td>
                                                            <td>{{ $letter_result->letter30_result->head }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Paraagraph</td>
                                                            <td>2</td>
                                                            <td>{{ $letter_result->letter30_result->salute }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Sign your name</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->letter30_result->close }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enclosure(attachment)</td>
                                                            <td>0.5</td>
                                                            <td>{{ $letter_result->letter30_result->enclosure }}</td>
                                                        </tr>
                                                </table>
                                                @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        @if($typingtest_value->typingtest->practise->name == "SpeedStatement30")
                                            @foreach($typing_test_result as $key => $letter_result)
                                                @if($letter_result->practisetype->name == "SpeedStatement30")
                                                    @if($typingtest_value->id == $letter_result->statementtest30_result->typing_test_result_id)

                                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                        <tr>
                                                            <th>Criteria</th>
                                                            <th>Total Marks</th>
                                                            <th>Marks Obtained</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Heading fig. format</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statementtest30_result->head }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Column Headings</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statementtest30_result->columnhead }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cells Alignment</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statementtest30_result->celalign }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Column Width</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statementtest30_result->colwidth }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Borders</td>
                                                            <td>1</td>
                                                            <td>{{ $letter_result->statementtest30_result->border }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Correct word marks</td>
                                                            <td>5</td>
                                                            <td>{{ $letter_result->statementtest30_result->former }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Total Marks</td>
                                                            <td>10</td>
                                                            <td>{{ $letter_result->statementtest30_result->total }}</td>
                                                        </tr>

                                                    </table>

                                                @endif
                                                @endif
                                            @endforeach
                                        @endif
                                        @if($typingtest_value->typingtest->practise->name == "SpeedStatement40")
                                            @foreach($typing_test_result as $key => $letter_result)
                                                @if($letter_result->practisetype->name == "SpeedStatement40")
                                                    @if($typingtest_value->id == $letter_result->statementtest40_result->typing_test_result_id)

                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <tr>
                                                                <th>Criteria</th>
                                                                <th>Total Marks</th>
                                                                <th>Marks Obtained</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Heading fig. format</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statementtest40_result->headfig }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Column Headings</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statementtest40_result->colheading }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Cells Alignment</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statementtest40_result->alignment }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Column Width</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statementtest40_result->width }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Borders</td>
                                                                <td>1</td>
                                                                <td>{{ $letter_result->statementtest40_result->borders }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Questions</td>
                                                                <td>5</td>
                                                                <td>{{ $letter_result->statementtest40_result->questions }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Correct word marks</td>
                                                                <td>10</td>
                                                                <td>{{ $letter_result->statementtest40_result->marksform }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Marks</td>
                                                                <td>10</td>
                                                                <td>{{ $letter_result->statementtest40_result->totmark }}</td>
                                                            </tr>
                                                        </table>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        @if($typingtest_value->typingtest->practise->name == "SpeedEmail30")
                                            @foreach($typing_test_result as $key => $email_result)
                                                @if($email_result->practisetype->name == "SpeedEmail30")
                                                    @if($typingtest_value->id == $email_result->emailtest30_result->typing_test_result_id)

                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <tr>
                                                                <th>Criteria</th>
                                                                <th>Total Marks</th>
                                                                <th>Marks Obtained</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Id</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->emailtest30_result->mailId }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Subject</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->emailtest30_result->mailSub }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Body</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->emailtest30_result->mailBody }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Attachment</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->emailtest30_result->mailSave }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Save</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->emailtest30_result->mailAtt }}</td>
                                                            </tr>
                                                        </table>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        @if($typingtest_value->typingtest->practise->name == "SpeedEmail40")
                                            @foreach($typing_test_result as $key => $email_result)
                                                @if($email_result->practisetype->name == "SpeedEmail40")
                                                    @if($typingtest_value->id == $email_result->email40_result->typing_test_result_id)

                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <tr>
                                                                <th>Criteria</th>
                                                                <th>Total Marks</th>
                                                                <th>Marks Obtained</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Email To</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailTo }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email CC</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailCc }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email BCC</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailBcc }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email Subject</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailSubject }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Body</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email40_result->EmailBody }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Attachment 1</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailAtt1 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mail Attachment 2</td>
                                                                <td>0.5</td>
                                                                <td>{{ $email_result->email40_result->EmailAtt2 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email Save</td>
                                                                <td>1</td>
                                                                <td>{{ $email_result->email40_result->EmailSend }}</td>
                                                            </tr>
                                                        </table>

                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>

                        </div>
                    </div>

                        {{-- diplay test reuslt --}}

{{--                        <div class="row">--}}
{{--                            <div class="col-xl-6">--}}
{{--                                <div class="card mb-6">--}}
{{--                                    <div class="card-header" style="background-color: #8FBC8F;">--}}
{{--                                        <b style="font-size: 20px;">Result Of Passage 40 WPM Practice (English)</b>--}}
{{--                                        <h6 style="font-style: italic;">Passage Number:,Time Taken:</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="card-body">--}}
{{--                                        Total Mistakes<hr>--}}
{{--                                        Total Marks<hr><br>--}}
{{--                                        Gross WPM -25<hr>--}}
{{--                                        Net WPM -23<hr><br>--}}
{{--                                        Total Marks-20<hr>--}}
{{--                                        Marks obtained-13<hr>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                       <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       @if($count == 0)

       <label>No Notices For You!!</label>

       @endif

       @foreach($custemNotification as $custem_value)

         @php
         $notice = json_decode($custem_value->data);
         $id = ($custem_value->id);


       echo "<a class='dropdown-item' href='http://localhost:/eswift/instituteadmin/notice/?id=$id++' > <label style='font-weight: bold;'> &nbsp; &nbsp; $notice->message</label></a>";

                            @endphp
                        </label></a>


                      @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>

      </div>
    </div>
  </div>
</div>
</main>


@endsection

@once
    @push('scripts')
    <script>
        $('a').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    },1000);
    return false;
});
    </script>

        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        {{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>  --}}
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-bar-demo.js') }}"></script> -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>


         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

        </script>

        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script src="{{ url('public/js/a.js') }}"></script>

 <script type="text/javascript">
$(function() {
    $('#basicExampleModal').modal('show');
});

      </script>

    @endpush
@endonce
