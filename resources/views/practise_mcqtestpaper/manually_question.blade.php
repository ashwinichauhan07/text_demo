@extends('layouts.admin')

@section('title', 'Select Question')

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
                                    <p>Select Question</p>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>

                                              <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>Is Mcq</th>
                                              </tr>

                                            </thead>
                                            <tfoot>

                                              <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>Is Mcq</th>
                                              </tr>

                                            </tfoot>

                                            <tbody>
                                              @foreach($questionData as $key => $que_value)
                                                <tr>
                                                  <td>
                                                    <input type="checkbox" name="que" value="{{ $que_value->id }}">
                                                  </td>
                                                  <td>{!! $que_value->que !!}</td>
                                                  <td>{{ $que_value->is_mcq == 1 ? "Yes" : "No" }}</td>
                                                </tr>
                                              @endforeach
                                            </tbody>

                                          </table>
                                        </div>

                                        <!-- Form for data send -->

                                        <form method="post" action="{{ route('practise_mcqtestpaper.manually_create_show') }}">

                                            @csrf

                                            <input type="hidden" name="subject_id" value="{{ $data['subject_id'] }}">

                                            <input type="hidden" name="mcq_type_id" value="{{ $data['mcq_type_id'] }}">

                                            {{-- <input type="hidden" name="total_writing_question" value="{{ $data['mcq_type_id'] }}"> --}}

                                            <input type="hidden" name="total_mcq_question" value="{{ $data['mcq_type_id'] }}">



                                            {{-- <input type="hidden" name="each_writing_mark" value="{{ $data['each_writing_mark'] }}"> --}}

                                            <input type="hidden" name="each_mcq_mark" value="{{ $data['each_mcq_mark'] }}">

                                            {{-- <input type="hidden" name="each_negative_writing_mark" value="{{ $data['each_negative_writing_mark'] }}"> --}}

                                            <input type="hidden" name="each_negative_mcq_mark" value="{{ $data['each_negative_mcq_mark'] }}">

                                            <input type="hidden" name="required_time" value="{{ $data['required_time'] }}">

                                            <input type="hidden" name="questionPaperName" value="{{ $data['questionPaperName'] }}">

                                            <select name="question[]" id="que" multiple style="display: none;">

                                            </select>


                                                <p class="text-center">
                                                    <button type="submit" class="btn btn-success btn-lg" id="submit_btn">continue</button>
                                                </p>



                                        </form>
                                        <!-- form for data send end -->

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

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


        <script type="text/javascript">
          $(document).ready(function() {
            $('#dataTable').DataTable( {
                initComplete: function () {
                    this.api().columns([1]).every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            } );
        } );



          var que = document.getElementById('que');
          var checkbox = document.querySelectorAll('input[type=checkbox]');

          count = 0;
          checkbox.forEach(function (item,index) {
                item.onclick = ()=> {

                    if(item.checked) {

                        var opt = document.createElement('option');
                        opt.value = item.value;
                        opt.id = item.value;
                        opt.innerHTML = item.value;
                        opt.selected = true;
                        que.appendChild(opt);

                        count++;

                    } else {

                        que.remove(index);
                    }
                }


          });

          var btn = document.getElementById("submit_btn");
          btn.onclick = (e)=> {
            if (count == 0) {
                e.preventDefault();
                alert("At Least 1 Question is Required.");
            }
          }


        </script>
    @endpush
@endonce
