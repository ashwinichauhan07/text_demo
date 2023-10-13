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
	  		<li class="breadcrumb-item active">Instructor Payments</li>
      </ol>
      <div class="row mt-4">
			  <div class="col-xl-12">
          <div class="card mb-4">
            <div class="card-body">
						@if ($errors->any())
						<div class="alert alert-danger">
							<strong>Whoops!</strong>There were some problems with your input. <br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif

					<form action="{{ route('instructorpayments.store') }}" method="POST">
							@csrf

							<div class="row">
							<!-- 	<div class="form-group col-md-4">
							      <label for="payment_id">Payment Id : </label>
                   @php $page =0; @endphp
								      <label>
                          {{ $page += 1 }}
                      </label>
							    </div>
 -->
							    <div class="form-group col-md-4">
							    	<label for="name">Instructor Name</label>
							    	<select id="instructor_id" class="form-control" name="name">
                    <option value="" name="name">Choose Instructor Name...</option>

                    @foreach($instructorData as $key=> $instructor_value)
                    @if($instructor_value->institute_id == auth()->id())

                    <option value="{{ $instructor_value->user_id }}">{{ $instructor_value->user->name }}</option>

                    @endif
                    @endforeach
                    </select>
							    </div>

							    <div class="form-group col-md-4">
							    	<label for="amount">Enter Amount</label>
							    		<input type="text" name="amount" class="form-control">
							    </div>

							    <div class="form-group col-md-4">
							    	<label for="mode">Payment Mode</label>
							    		<select name="mode" class="form-control" id="mode">
                        <option selected>Choose Payment mode</option>
                        <option value="1">Cash</option>
                        <option value="2">Cheque</option>
                      </select>
							    </div>

                  <div class="form-group col-md-4">
                    <label for="cheque_number">Cheque Number</label>
                      <input type="text" name="cheque_number" class="form-control">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="cheque_date">Cheque Date</label>
                    <input type="date" name="cheque_date" class="form-control">
                  </div>


								<div class="col-xs-12 col-sm-12 col-md-12 text-center">
									<button type="submit" class="btn btn-dark">Payment</button>
								</div>
							</div>
					</div>
					</form>
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
