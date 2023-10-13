@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">Create GR Number</li>
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

                    	<form action="{{ route('grnumbers.store') }}" method="POST">
                    		@csrf

                    		<div class="row">
                    			<div class="form-group col-md-4">
                    				<div class="form-group">
                    					<strong>GR Number:</strong>
                    					<input type="text" name="grnumber" class="form-control" placeholder="GR Number Start With {{ $institute }}">
                    				</div>
                    			</div>
                    			<div class="col-xs-12 col-sm-12 col-md-12">
                    				<button type="submit" class="btn btn-dark">Submit</button>
                    			</div>
                    		</div>
                    	</form>
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
