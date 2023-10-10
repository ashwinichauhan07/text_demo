@extends('layouts.admin')

@section('title', 'Keyboard Practises')

@section('sidebar')

@parent

@endsection

@section('content')
<main>
        <div class="container-fluid">

             <h1 class="mt-4"></h1>
            <ol class="breadcrumb mb-4 justify-content-center" style="font-weight: bold; font-size:20px;">
                {{ $studid->name }}   {{ $studid->student->father_name }} {{ $studid->student->lastname }}

                <li class="breadcrumb-item active"> </li>

                 {{--  <a class="btn btn-dark" style="margin-left: 59em;"
                   href="{{ route('studentgrowth.viewresult',1)}}">Back</a>  --}}

                   {{--  <button onclick="history.back()" class="btn btn-dark" style="margin-left: 59em;" >Back</button>  --}}
            </ol>



            <div class="col-lg-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" cellspacing="0" style="width: 700px; margin-left: 20%;">
                    <tbody>
                {{--  @foreach ($typingtest_result as  $key => $typingtest_value)  --}}


                  <tr class="table-success" style="text-align: center;
                    font-size: 20px">
                          <th scope="row" colspan="2">Result</th>

                     </tr>

                     <tr>
                        <th scope="row">Total Marks</th>
                         <td style="text-align: center;">{{ $typingtest_result->tmark }}</td>

                      </tr>

                    <tr>
                          <th scope="row">Time</th>
                           <td style="text-align: center;">{{ $typingtest_result->time }}</td>

                     </tr>

                        <tr>
                          <th scope="row">Count Mistake</th>
                           <td style="text-align: center;">{{ $typingtest_result->countmistake }}</td>

                        </tr>

                        @if($practise_name->name == "SpeedLetter30")
                        {{--  @if($typingtest_result->id == $typingtest_result->letter30_result->typing_test_result_id)  --}}

                        <tr>
                            <th scope="row">Heading</th>
                             <td style="text-align: center;">{{ $typingtest_result->letter30_result->head }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Reference no and Date</th>
                             <td style="text-align: center;">{{ $typingtest_result->letter30_result->reference }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Address of Recipient</th>
                             <td style="text-align: center;">{{ $typingtest_result->letter30_result->add }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Subject and reference</th>
                             <td style="text-align: center;">{{ $typingtest_result->letter30_result->sub }}</td>

                          </tr>


                          <tr>
                            <th scope="row">Salutation</th>
                             <td style="text-align: center;">{{ $typingtest_result->letter30_result->salute }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Salutation</th>
                             <td style="text-align: center;">{{ $typingtest_result->letter30_result->paragraph }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Sign your name</th>
                             <td style="text-align: center;">{{ $typingtest_result->letter30_result->close }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Enclosure(attachment)</th>
                             <td style="text-align: center;">{{ $typingtest_result->letter30_result->enclosure }}</td>

                          </tr>

                          @elseif($practise_name->name == "SpeedStatement30")

                          <tr>
                            <th scope="row">Heading fig. format</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest30_result->head }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Column Headings</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest30_result->columnhead }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Cells Alignment</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest30_result->celalign }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Column Width</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest30_result->colwidth }}</td>

                          </tr>


                          <tr>
                            <th scope="row">Borders</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest30_result->border }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Correct word marks</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest30_result->former }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Total Word</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest30_result->total }}</td>

                          </tr>

                          @elseif($practise_name->name == "SpeedEmail30")

                          <tr>
                            <th scope="row">Mail Id</th>
                             <td style="text-align: center;">{{ $typingtest_result->emailtest30_result->mailId }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Mail Subject</th>
                             <td style="text-align: center;">{{ $typingtest_result->emailtest30_result->mailSub }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Mail Body</th>
                             <td style="text-align: center;">{{ $typingtest_result->emailtest30_result->mailBody }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Mail Attachment</th>
                             <td style="text-align: center;">{{ $typingtest_result->emailtest30_result->mailAtt }}</td>

                          </tr>


                          <tr>
                            <th scope="row">Mail Save</th>
                             <td style="text-align: center;">{{ $typingtest_result->emailtest30_result->mailSave }}</td>

                          </tr>

                          @elseif($practise_name->name == "SpeedLetter40")



                          @elseif($practise_name->name == "SpeedStatement40")

                          <tr>
                            <th scope="row">Heading fig. format</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest40_result->headfig }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Column Headings</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest40_result->colheading }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Cells Alignment</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest40_result->alignment }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Column Width</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest40_result->width }}</td>

                          </tr>


                          <tr>
                            <th scope="row">Borders</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest40_result->borders }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Question</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest40_result->questions }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Correct word marks</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest40_result->marksform }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Total Word</th>
                             <td style="text-align: center;">{{ $typingtest_result->statementtest40_result->totmark }}</td>

                          </tr>
                          @elseif($practise_name->name == "SpeedEmail40")

                          <tr>
                            <th scope="row">Email To</th>
                             <td style="text-align: center;">{{ $typingtest_result->email40_result->EmailTo }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Email CC</th>
                             <td style="text-align: center;">{{ $typingtest_result->email40_result->EmailCc }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Email BCC</th>
                             <td style="text-align: center;">{{ $typingtest_result->email40_result->EmailBcc }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Email Subject</th>
                             <td style="text-align: center;">{{ $typingtest_result->email40_result->EmailSubject }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Mail Body</th>
                             <td style="text-align: center;">{{ $typingtest_result->email40_result->EmailBody }}</td>

                          </tr>


                          <tr>
                            <th scope="row">Mail Attachment 1</th>
                             <td style="text-align: center;">{{ $typingtest_result->email40_result->EmailAtt1 }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Mail Attachment 2</th>
                             <td style="text-align: center;">{{ $typingtest_result->email40_result->EmailAtt2 }}</td>

                          </tr>

                          <tr>
                            <th scope="row">Email Save</th>
                             <td style="text-align: center;">{{ $typingtest_result->email40_result->EmailSend }}</td>

                          </tr>


                          @endif


                        <tr  class="table-success">
                          <th scope="row">Obtain Marks</th>
                          <td style="text-align: center;">{{ $typingtest_result->obtmark }}</td>

                        </tr>





                             {{--  @endforeach  --}}


                    </tbody>

                    </table>
                    </div>
                    <div class="text-center">
                    <button onclick="history.back()" class="btn btn-dark center">Back</button>
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
