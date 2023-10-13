@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item active">Create Document</li>
    </ol>
    <div class="row mt-4">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

        <!-- If want show all error in one place  -->

        <!-- Form for add Institute  -->
        <form method="POST" action="{{ route('document.store') }}">
           @csrf

          <div class="form-row">

            <div class="form-group col-md-6">
                <label for="inputEmail4">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">

                <!-- if want show error in single  -->
              @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror

              </div>

          </div>

          <button type="submit" class="btn btn-dark">Submit</button>

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
