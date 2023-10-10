@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">

    	 <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Show Instructor Added Student & Installment</li>

                         </ol>
        <div class="card mb-4">

            <div class="col-xl-12">
                <div class="card-body">

                  <form>

                   	 <div class="form-row">

                   <div class="form-group col-md-6 ">
                <label for="name">Instructor Name</label>
                    <select id="instructor_id" class="form-control" name="name">
                    <option value="" name="name">Choose Instructor Name...</option>

                    @foreach($instructorData as $key=> $instructor_value)
                    @if($instructor_value->institute_id == auth()->id())

                    <option value="{{ $instructor_value->user->id }}">{{ $instructor_value->user->name }}</option>

                    @endif
                    @endforeach
                    </select>
               <!--  -->
              </div>


                   <div class="form-group col-md-6 ">
                <label for="name">Choose Month</label>
                    <select id="month_id" class="form-control" name="month_id">

                      <option value="1">January</option>
                      <option value="2">February</option>
                      <option value="3">March</option>
                      <option value="4">April</option>
                      <option value="5">May</option>
                      <option value="6">June</option>
                      <option value="7">July</option>
                      <option value="8">August</option>
                      <option value="9">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
               <!--  -->
              </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark" name="student" value="student_data">Student Added In Current Month</button>
                 <button type="ooo" class="btn btn-dark" name="studentInstallment" value="studentInstallment_data">Current Month Installments</button>
              </div>
                </div>
                </div>
                </form>
            </div>


            <div>


              <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
          <tr>
            <th>No</th>
            <th>Date</th>
            <th>Name</th>
            <th>Profile Photo</th>
          </tr>
        </thead>
        <tbody>

            @php $page =0; @endphp
          @foreach ($student as $student_value)
          <tr>
            <td>{{ $page += 1 }}</td>
            <td>{{ $student_value->created_at }}</td>
            <td>{{ $student_value->user->name }} {{ $student_value->father_name }} {{ $student_value->lastname }}</td>
            <td style="width: 25%;"><img src="{{asset('public/images')}}/{{ $student_value->student_img }}" style="width: 50% ;" /></td>
          </tr>

          @endforeach

          </tbody>
          <tfoot>
          <tr>
            <th>No</th>
            <th>Date</th>
            <th>Name</th>
            <th>Profile Photo</th>
          </tr>
          </tfoot>
        </table>
      </div>

            </div>

            <br>

            <div class="table-responsive">
               <table class="table table-striped table-bordered" id="myTable" width="100%" cellspacing="0">
               <thead>
          <tr>
             <th>No</th>
            <th>Date</th>
            <th>Name</th>
            <th>mode</th>
            <th>Amount Paid</th>
          </tr>
        </thead>
        <tbody>

            @php $page =0; @endphp
          @foreach ($student_installments as $student_value)
          <tr>
            <td>{{ $page += 1 }}</td>
            <td>{{ $student_value->created_at }}</td>
            <td>{{ $student_value->student->user->name }} {{ $student_value->student->father_name }} {{ $student_value->student->lastname }}</td>
            <td>@if($student_value->mode == 1)
                   CASH
                @else
                   CHECQE NO ({{ $student_value->check_number }})
                @endif
             </td>
             <td>{{ $student_value->amount}}</td>

          </tr>

          @endforeach

          </tbody>
          <tfoot>
          <tr>
             <th>No</th>
            <th>Date</th>
            <th>Name</th>
            <th>mode</th>
            <th>Amount Paid</th>
          </tr>
          </tfoot>
        </table>


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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script> -->
         <script>

        </script>


        <script type="text/javascript">
           window.onload = function() {

        var date = new Date();

        var month_data = date.getMonth();

        var months =  month;

       // console.log(date.getMonth() + 1);

       var month = document.getElementById('month_id');

       // console.log(month.options.length);

       // month.options.length=0;

       for (var i = 0; i < month.options.length; i++) {

        if (month.options[i].value == date.getMonth() + 1) {

           console.log(month.options[i].value);

           month.options[i].selected = true;
        }


       }

    };

          $(document).ready( function () {
          $('#myTable').DataTable();
      } );

          $(document).ready( function () {
          $('#dataTable').DataTable();
      } );
        </script>


    @endpush
@endonce
