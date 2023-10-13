@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

 @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Deleted Student Installment Details </i>

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

					@php
                        $institute = DB::table('users')
                        ->where('id', $student_value->user_id)
                          ->pluck('name')
                          ->first();
                       @endphp
					<tr>


						<td>{{ $page += 1 }}</td>
						<td>{{ $institute }} {{ $student_value->father_name }} {{ $student_value->lastname }} </td>
						<td>{{ $student_value->totalfees }}</td>
						<td>{{ $student_value->paidfees }}</td>
						<td>{{ $student_value->unpaidfees }}</td>
						<td>
							@foreach ($courses as $key => $course_value)
							@if($student_value->id == $course_value->student_id)

			                   {{ $course_value->course->name }}&nbsp;,&nbsp;
                            @endif
			                @endforeach
						</td>
						<td>
							 @foreach ($student_subject as $key => $subject_value)
							 @if($student_value->id == $subject_value->student_id)

							 @if($subject_value->old == 0)
			                   {{ $subject_value->subject->name }}&nbsp;,&nbsp;
			                 @endif
			                    @endif
			                 @endforeach
						</td>
						<td>


						<a href="{{ route('studentinfo.showinstallmentrecipt', $student_value->id ) }}" class="btn btn-info"
						style="padding-left: 16px; padding-right: 16px;
                         margin-bottom: 4px;"><i class="fa fa-info"></i></a>
                         &nbsp;&nbsp;<br>





						<form action="{{ route('studentinfo.destroy', $student_value->id) }}" method="POST"
							style=" margin-bottom: 4px;">
							@csrf
							@method('DELETE')

							   <button type="submit" class="btn btn-danger delete">
							   	<i class="fas fa-trash-alt"></i>
							   </button>
						</form>




						    	<a href="{{ route('studentinfo.restore', $student_value->id) }}" class="btn btn-success">
								<i class="fas fa-trash-restore"></i>

							    </a>








                     </td>
                      @endforeach
				</tbody>
					<tfoot>
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

         <script type="text/javascript">
        	window.onload = ()=> {
        		var del = document.querySelectorAll(".delete");
        		del.forEach(function(item, index) {
        			item.onclick = ()=> {
        				if (confirm("Are you sure to delete it!")) {
        					return true;
        				} else {
        					return false;
        				}
        			}
        		});
        	}
        </script>
    @endpush
@endonce
