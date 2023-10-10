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
  			<li class="breadcrumb-item active">Show Instructor Details <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('instructors.index') }}">Back</a></li>

        </ol>
        <div>

        </div>
        <div class="row mt-4">
			<div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">
                    	<div class="form-row">
                    		<div class="form-group col-6">
                    			<label for="instructorname">Instructor Name :</label>
                    			<p class="alert alert-success">
                    				{{ $instructor->user->name }}
                    			</p>
                    		</div>

						    <div class="form-group col-6">
						    	<label for="instructorname">Father/Husband Name :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->father_name }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="instructorname">Mother Name :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->mother_name }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="Gender">Gender :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->gender }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="PhoneNumber">Phone Number:</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->phone_no }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="Email">Email :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->user->email }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="Address">Address :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->address }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="Stream">Stream :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->stream }}
						    	</p>
						    </div>

						    <div class="form-group col-4">
						    	<label for="University">University :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->university }}
						    	</p>
						    </div>

						    <div class="form-group col-4">
						      <label for="Passingyear">Passing year :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->passingyear }}
						    	</p>
						    </div>

						    <div class="form-group col-4">
						    	<label for="Percent">Percent :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->percent }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="Grade">Grade :</label>
						    	<p class="alert alert-success">
						    		{{ $instructor->grade }}
						    	</p>
						    </div>

						    <div class="form-group col-6">
						    	<label for="IdentityProfilePhoto:">Identity Profile Photo:</label>
						    	<p class="alert alert-success">
						    		<img src="{{asset('public/images')}}/{{ $instructor->identity_img }}" id="previewImg" name="identity_img" alt="" style="max-width:130px;margin-top: 20px;"  />
						    	</p>
						    </div>
						</div>
					</div>
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
