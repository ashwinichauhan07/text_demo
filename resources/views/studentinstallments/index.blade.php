@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

 @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>

        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Student Installment Details </i>
                    <a href="{{ route('studentinstallments.create') }}" class="btn btn-dark float-right">Add Installment</a>
            </div>
			<div class="col-xl-12">
                <div class="card-body">
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif

				<div class="table-responsive">
			         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			        <thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Total Fees</th>
						<th>Paid Fees</th>
						<th>Balance Fees</th>
						<th>Course</th>
						<th>Subject</th>
						<th>Student Installment</th>
					</tr>
				</thead>
				<tbody>
                    @php $page =0; @endphp
					@foreach ($students as $key => $student_value)
					<tr>
						<td>{{ $page += 1 }}</td>
						<td>{{ $student_value->user->name }} {{ $student_value->father_name }} {{ $student_value->lastname }} </td>
						<td>{{ $student_value->totalfees }}</td>
						<td>{{ $student_value->paidfees }}</td>
						<td>{{ $student_value->unpaidfees }}</td>
						<td>
							@foreach ($student_value->student_course->unique('course_id') as $key => $course_value)

			                   {{ $course_value->course->name }}&nbsp;,&nbsp;

			                @endforeach
						</td>
						<td>
							 @foreach ($student_value->student_subject as $key => $subject_value)
							 @if($subject_value->old == 0)
			                   {{ $subject_value->subject->name }}&nbsp;,&nbsp;
			                 @endif
			                 @endforeach
						</td>

						<td>



                         <a href="{{ route('studentinstallments.show', $student_value->id ) }}" class="btn btn-info" style="padding-left: 16px; padding-right: 16px;
                         margin-bottom: 4px;"><i class="fa fa-info"><input type="text" value="0" hidden></i></a>
                         &nbsp;&nbsp;<br>







                     </td>
                      @endforeach
				</tbody>
					<tfoot>
						<tr>
						<th>No</th>
						<th>Name</th>
						<th>Total Fees
							{{ $revenue }}
						</th>
						<th>Paid Fees</th>
						<th>Balance Fees</th>
						<th>Course</th>
						<th>Subject</th>
						<th>Student Installment</th>
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
