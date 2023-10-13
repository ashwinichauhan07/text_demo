@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
  <div class="container-fluid">
    <div class="row mt-4">
      <div class="col-xl-6">

      </div>
      <div class="col-xl-6">
        <div class="row mt-4">


        </div>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"> Student Repeat Admission List </i>
          <a href="{{ route('instituteadmin.dashboard') }}" class="btn btn-dark float-right">Back</a>
      </div>
      <div class="col-xl-12">
        <div class="card-body">
        @if (session('status'))
      	    <div class="alert alert-success">
      	        {{ session('status') }}
      	    </div>
      	@endif
        <div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
					    <tr>
                <th>Sr.No</th>
                <th>Student Name</th>
                <th>Addmission Date</th>
                <th>Mobile No</th>
                <th>Subject</th>
                <th>Batches</th>
					    </tr>
						</thead>
						<tbody>

							@foreach($student_repeat as $key => $student_value)
							<tr>
								<td>{{ $key++ }}</td>

								<td>{{ $student_value->student->user->name}}</td>
                <td>{{ $student_value->doaddmission}}</td>
								<td>{{ $student_value->student->student_mob}}</td>
								<td>
								 @foreach ($student_value->student->student_subject as $key => $subject_value)

                                    @if($subject_value->old == 0)

                                    {{ $subject_value->subject->name }}&nbsp;,&nbsp;

                                    @endif

                                    @endforeach
                    </td>
                      <td>
                                	 @foreach ($student_value->student->student_batch as $key => $student_value)
                                       {{ $student_value->itiming->start_time }} to
                                       {{ $student_value->itiming->end_time }}<br>
                                     @endforeach
                                </td>


							</tr>
							@endforeach
						</tbody>

				<tfoot>
			    <tr>
                <th>Sr.No</th>
                <th>Student Name</th>
                <th>Addmission Date</th>
                <th>Mobile No</th>
                <th>Subject</th>
                <th>Batches</th>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ url('chartJs/admin/chart-area-demo.js') }}"></script> -->
        <!-- <script src="{{ url('chartJs/admin/chart-pie-demo.js') }}"></script> -->
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script> -
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/admin/datatables-demo.js') }}"></script>


    @endpush
@endonce
