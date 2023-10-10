@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
	<div class="container-fluid">
		<ol class="breadcrumb mb-4 mt-4">
  		<!-- If want show all error in one place  -->
  			<li class="breadcrumb-item active">Show MCQ Test Details <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('mcqtest.index') }}">Back</a></li>
           
        </ol>
        <div>
        	 
        </div>
        <div class="row mt-4">
			<div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">
                    	<div class="form-row">
                    		<div class="form-group col-6">
                    			<label for="subjectname">Subject Name :</label>
                    			<p class="alert alert-success">
                    				{{ $subject->name }}
                    			</p>
                    		</div>

						    <div class="form-group col-6">
						    	<label for="instructorname">MCQ Type Name :</label>
						    	<p class="alert alert-success">
						    		{{ $mcqtype->name }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="instructorname">Set Time For Exam :</label>
						    	<p class="alert alert-success">
						    		{{ $mcqtest->timer }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="PhoneNumber">Set Mark Per Question:</label>
						    	<p class="alert alert-success">
						    		{{ $mcqtest->que_mark }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="Email">Passing Criteria :</label>
						    	<p class="alert alert-success">
						    		{{ $mcqtest->criteria }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="Gender">Test Date :</label>
						    	<p class="alert alert-success">
						    		{{ $mcqtest->test_date }}
						    	</p>
						    </div>  
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</main>


@endsection

@once
    @push('scripts')
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/datatables-demo.js') }}"></script>
    @endpush
@endonce