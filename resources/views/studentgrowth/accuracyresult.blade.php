@extends('layouts.admin')

@section('title', 'Keyboard Practises')

@section('sidebar')

@parent

@endsection

@section('content')
<main>
        <div class="container-fluid">

            <h1 class="mt-4"></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active" > </li>

                  <a class="btn btn-dark" style="margin-left: 59em;"
                   href="{{ route('studentgrowth.index')}}">Back</a>
            </ol>


            <div class="col-lg-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" cellspacing="0" style="width: 700px; margin-left: 20%;">

                    <tbody>



                   <tr class="table-success" style="text-align: center;
                    font-size: 20px">
                          <th scope="row" colspan="2">Result</th>

                     </tr>

                    <tr>
                          <th scope="row">Time</th>
                          <td style="text-align: center;">{{ $typingpractise_result->time }}</td>

                     </tr>


                        <tr>
                          <th scope="row">Total Marks</th>
                          <td style="text-align: center;">{{ $typingpractise_result->tmark }}</td>

                        </tr>


                        <tr>
                          <th scope="row">Count Mistake</th>
                          <td style="text-align: center;">{{ $typingpractise_result->countmistake }}</td>

                        </tr>

                         @if($practise_name->name == "SpeedLetter30")


                         <tr>
                          <th scope="row">Head</th>
                          <td style="text-align: center;">
                            {{ $typingpractise_result->letter_result->head }}


                      </td>

                        </tr>


                        <tr>
                          <th scope="row">Reference</th>
                          <td style="text-align: center;">
                                  {{ $typingpractise_result->letter_result->reference }}

                          </td>

                        </tr>

                        <tr>
                          <th scope="row">Add</th>
                          <td style="text-align: center;">
                                  {{ $typingpractise_result->letter_result->add }}

                          </td>

                        </tr>

                        <tr>
                          <th scope="row">Sub</th>
                          <td style="text-align: center;">


                                   {{ $typingpractise_result->letter_result->sub }}

                          </td>

                        </tr>

                         <tr>
                          <th scope="row">Salute</th>
                          <td style="text-align: center;">


                              {{ $typingpractise_result->letter_result->salute }}

                          </td>

                        </tr>

                         <tr>
                          <th scope="row">Paragraph</th>
                          <td style="text-align: center;">

                              {{ $typingpractise_result->letter_result->paragraph }}

                          </td>

                        </tr>

                         <tr>
                          <th scope="row">Close</th>
                          <td style="text-align: center;">
                       {{ $typingpractise_result->letter_result->close }}

                          </td>

                        </tr>

                        <tr>
                          <th scope="row">Enclosure</th>
                          <td style="text-align: center;">
                        {{ $typingpractise_result->letter_result->enclosure }}

                          </td>

                        </tr>



                        @elseif($practise_name->name == "SpeedStatement30")

                          <tr>
                            <th scope="row">Head</th>
                             <td style="text-align: center;">
                         {{ $typingpractise_result->statement30_result->head }}

                             </td>

                          </tr>


                          <tr>
                            <th scope="row">ColumnHead</th>
                             <td style="text-align: center;">
                       {{ $typingpractise_result->statement30_result->columnhead }}

                             </td>

                          </tr>


                          <tr>
                            <th scope="row">Celalign</th>
                             <td style="text-align: center;">
                {{ $typingpractise_result->statement30_result->celalign }}

                             </td>

                          </tr>


                            <tr>
                            <th scope="row">ColWidth</th>
                             <td style="text-align: center;">
                          {{ $typingpractise_result->statement30_result->colwidth }}

                             </td>

                          </tr>



                          <tr>
                            <th scope="row">Border</th>
                             <td style="text-align: center;">
                        {{ $typingpractise_result->statement30_result->border }}

                             </td>

                          </tr>


                        <tr>
                            <th scope="row">Former</th>
                             <td style="text-align: center;">

                             {{ $typingpractise_result->statement30_result->former }}

                             </td>

                          </tr>


                          <tr>
                            <th scope="row">Total</th>
                             <td style="text-align: center;">
                              {{ $typingpractise_result->statement30_result->total }}

                             </td>

                          </tr>

                          @elseif($practise_name->name == "SpeedEmail30")

                          <tr>
                            <th scope="row">MailId</th>
                             <td style="text-align: center;">
                              {{ $typingpractise_result->email30_result->mailId }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">MailSub</th>
                             <td style="text-align: center;">
                              {{ $typingpractise_result->email30_result->mailSub }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">MailBody</th>
                             <td style="text-align: center;">
                             {{ $typingpractise_result->email30_result->mailBody }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">MailSave</th>
                             <td style="text-align: center;">
                              {{ $typingpractise_result->email30_result->mailSave }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">MailAtt</th>
                             <td style="text-align: center;">
                   {{ $typingpractise_result->email30_result->mailAtt }}

                             </td>

                          </tr>

                        @elseif($practise_name->name == "SpeedLetter40")



                      @elseif($practise_name->name == "SpeedStatement40")

                       <tr>
                            <th scope="row">HeadFig</th>
                             <td style="text-align: center;">

                   {{ $typingpractise_result->statement40_result->headfig }}
                             </td>

                          </tr>

                           <tr>
                            <th scope="row">Colheading</th>
                             <td style="text-align: center;">
                       {{ $typingpractise_result->statement40_result->colheading }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">Alignment</th>
                             <td style="text-align: center;">

                            {{ $typingpractise_result->statement40_result->alignment }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">Width</th>
                             <td style="text-align: center;">
                             {{ $typingpractise_result->statement40_result->width }}

                             </td>

                          </tr>



                           <tr>
                            <th scope="row">Borders</th>
                             <td style="text-align: center;">
                          {{ $typingpractise_result->statement40_result->borders }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">Questions</th>
                             <td style="text-align: center;">

                        {{ $typingpractise_result->statement40_result->questions }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">MarksForm</th>
                             <td style="text-align: center;">

                           {{ $typingpractise_result->statement40_result->marksform }}

                             </td>

                          </tr>

                            <tr>
                            <th scope="row">TotMark</th>
                             <td style="text-align: center;">

                       {{ $typingpractise_result->statement40_result->totmark }}

                             </td>

                          </tr>

                         @elseif($practise_name->name == "SpeedEmail40")

                         <tr>
                            <th scope="row">EmailSend</th>
                             <td style="text-align: center;">
                        {{ $typingpractise_result->email40_result->EmailSend }}

                             </td>

                          </tr>

                           <tr>
                            <th scope="row">EmailTo</th>
                             <td style="text-align: center;">

                             {{ $typingpractise_result->email40_result->EmailTo }}

                             </td>

                          </tr>


                            <tr>
                            <th scope="row">EmailCc</th>
                             <td style="text-align: center;">

                   {{ $typingpractise_result->email40_result->EmailCc }}

                             </td>

                          </tr>


                        <tr>
                            <th scope="row">EmailBcc</th>
                             <td style="text-align: center;">
                           {{ $typingpractise_result->email40_result->EmailBcc }}

                             </td>

                          </tr>


                          <tr>
                            <th scope="row">EmailSubject</th>
                             <td style="text-align: center;">

                           {{ $typingpractise_result->email40_result->EmailSubject }}

                             </td>

                          </tr>


                            <tr>
                            <th scope="row">EmailBody</th>
                             <td style="text-align: center;">
                               {{ $typingpractise_result->email40_result->EmailBody }}

                             </td>

                          </tr>

                             <tr>
                            <th scope="row">EmailAtt1</th>
                             <td style="text-align: center;">

                           {{ $typingpractise_result->email40_result->EmailAtt1 }}

                             </td>

                          </tr>

                             <tr>
                            <th scope="row">EmailAtt2</th>
                             <td style="text-align: center;">

                         {{ $typingpractise_result->email40_result->EmailAtt2 }}

                             </td>

                          </tr>

                          @endif


                      <tr class="table-success">
                          <th scope="row">Obtain Marks</th>
                        <td style="text-align: center;">{{ $typingpractise_result->obtmark }}</td>

                        </tr>





                    </tbody>

                    </table>
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
