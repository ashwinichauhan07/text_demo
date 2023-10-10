@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item active">Create MCQ Test</li>
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

            <form method="POST" action="{{ route('mcqtest.store') }}">
            @csrf
            <div class="form-row">
              <div class="form-group col-4">
                <label for="subject_id">Select Subject</label>
                <select name="subject_id" class="form-control" id="">

                  @foreach($subjectData as $key => $subject_value)

                  <option value="{{ $subject_value->id }}">
                    {{ $subject_value->name }}
                  </option>

                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-4">
                <label for="inputState">Select MCQ Type</label>
                <select id="inputState" class="form-control" name="mcq_type_id">
                  <option value="" name="mcq_type_id">Choose MCQ Type</option>

                  @error('mcq_type_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  @foreach($mcqtypeData as $key=> $mcqtype_value)
                  <option value="{{ $mcqtype_value->id }}">{{ $mcqtype_value->name }}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group col-md-4">
                <label for="inputEmail4">Set Time</label>
                <input type="time" class="form-control" name="timer" placeholder="Set Time" value="{{ old('timer') }}">
                <!-- if want show error in single  -->
                @error('timer')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail4">Set Per Question Mark</label>
                <input type="text" class="form-control" name="que_mark" placeholder="Set Per Question Mark" value="{{ old('que_mark') }}">
                <!-- if want show error in single  -->
                @error('que_mark')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail4">Set Criteria</label>
                <input type="text" class="form-control" name="criteria" placeholder="Set Criteria" value="{{ old('criteria') }}">
                <!-- if want show error in single  -->
                @error('criteria')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail4">Test Date</label>
                <input type="date" class="form-control" name="test_date" placeholder="Set Test Date" value="{{ old('test_date') }}">
                <!-- if want show error in single  -->
                @error('test_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-dark">Submit</button>
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
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ url('chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('chartJs/chart-pie-demo.js') }}"></script> -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/datatables-demo.js') }}"></script>
    @endpush
@endonce