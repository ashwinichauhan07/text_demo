@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">

    	 <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Showing Revenue Report</li>
                         </ol>
        <div class="card mb-4">

            <div class="col-xl-12">
                <div class="card-body">



                  <form>

                <div class="form-row">
                <div class="form-group col-md-6">
                <label for="session_id">From Date</label>
                  <input type="date" class="form-control" name="fromdate" placeholder="Enter Year" value="">
                </div>

                 <div class="form-group col-md-6">
                     <label for="firstname">To Date</label>
                     <input type="date" class="form-control" name="todate" placeholder="Enter Year" value="">
                 </div>
                </div>

              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark">Show Revenue</button>
              </div>
                </div>
                </div>
                </form>
            </div>
                <div style="background-color: #141f1f; margin: 20px; border-radius: 10px;" >
                 <h1 style="font-size: 25px; padding: 6px; color: #00ff00; text-align: center;"><b>Total Revenue : {{ $revenue }}</b></h1>
            </div>
<div>
              <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
          <tr>
            <th>No</th>
            <th>Student Name</th>
            <th>Date of Installment</th>
            <th>Paid Amount</th>
            <th>Total Paid Amount</th>
            <th>Balance Amount</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
                    @php $page =0; @endphp
          {{--  @foreach($data as $key => $student_value)

          <tr>
            <td>{{ $page += 1 }}</td>
            <td>{{ $student_value->user->name }}</td>
            <td>{{ $student_value->doaddmission  }}</td>
            <td>{{ $student_value->totalfees }}</td>
            <td>{{ $student_value->paidfees }}</td>
            <td>{{ $student_value->unpaidfees }}</td>
            <td><a href="{{ route('studentinstallments.show', $student_value->id ) }}" class="btn btn-info"><i class="fa fa-info"></i></a>
                         &nbsp;&nbsp;<br><br></td>

          @endforeach  --}}

          @foreach($studentData as $key => $student_value)

          <tr>
            <td>{{ $page += 1 }}</td>
            <td>{{ $student_value->student->user->name }} {{ $student_value->student->father_name }} {{ $student_value->student->lastname }}</td>
            <td>{{ $student_value->installment_date  }}</td>
            <td>{{ $student_value->amount }}</td>
            <td>{{ $student_value->paidfees }}</td>
            <td>{{ $student_value->unpaidfees }}</td>
            <td><a href="{{ route('studentinstallments.show', $student_value->student_id ) }}" class="btn btn-info"><i class="fa fa-info"></i></a>
                         &nbsp;&nbsp;<br><br></td>

          @endforeach
        </tbody>
          <tfoot>
            <tr>
            <th>No</th>
            <th>Student Name</th>
            <th>Date of Installment</th>
            <th>Paid Amount</th>
            <th>Total Paid Amount</th>
            <th>Balance Amount</th>
            <th>Details</th>
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

        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

    @endpush
@endonce
