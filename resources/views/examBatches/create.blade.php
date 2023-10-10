@extends('layouts.demo')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
      <!-- If want show all error in one place  -->
        <li class="breadcrumb-item active">Create Exam Batches</li>
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

          @if ($message = Session::get('error'))
          <div class="alert alert-danger">
              <p>{{ $message }}</p>
          </div>
          @endif

          <form action="{{ route('examBatches.store') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="form-group col-md-6">
                    <label for="exam_name">Exam Name</label>
                    <select id="exam_name" name="exam_name" class="form-control">
                        <option value="" name="exam_name">Select Exam Name...</option>
                        @foreach($ExamData as $key => $Exam_value)

                            <option value="{{ $Exam_value->id }}">{{ $Exam_value->name }}</option>

                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="name">Select Subject</label>
                        <select class="form-control" name="subject_id" id="subject_id">
                            <option value="" name="subject_id">Select Subject...</option>
                            @foreach($subjectData as $key => $subject_value)

                            <option value="{{ $subject_value->id }}">{{ $subject_value->name }}</option>

                            @endforeach
                        </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="batch_number">Batch Name</label>
                    <input type="name" class="form-control" name="batch_number" placeholder="Batch Name" value="{{ old('batch_number') }}">
                    <!-- if want show error in single  -->

                </div>

             <div class="form-group col-md-6">
                <label for="examdate">Exam Date</label>
                <input type="date" class="form-control" name="exam_date" value="{{ old('exam_date') }}" id="myDate" onchange="myFunction(this.value)">
                <!-- if want show error in single  -->
              </div>
                <div class="form-group col-md-6">
                <label for="examdate" >Day</label>

                <input type="text" id=day class="form-control" name="day" >


              </div>

            <div class="form-group col-md-6">
                <label for="start_time">Batch Start Time</label>
                <input type="time" class="form-control" name="start_time" placeholder="hh:mm AM/PM" value="{{ old('start_time') }}">
                <!-- if want show error in single  -->

            </div>
            <div class="form-group col-md-6">
                <label for="end_time">Batch End Time</label>
                <input type="time" class="form-control" name="end_time" placeholder="hh:mm AM/PM" value="{{ old('end_time') }}">
                <!-- if want show error in single  -->
            </div>


              <!-- <div class="form-group col-md-6">
                <label for="center_name">Institute Center Name</label>
                <input type="text" class="form-control" name="center_name" placeholder="Enter Center Name" value="{{ old('center_name') }}">

            </div> -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark" >Create</button>
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
        <script src="{{ url('public/assets/js/select2.min.js') }}"></script>

        <script type="text/javascript">

            function myFunction(val) {
              // console.log(val);
           // var x = document.getElementById("myDate").value;

           var d = new Date(val);


           var str = d.toString().split(" ");
           // console.log(str);

           var day = document.getElementById("day");
           day.value = str[0];
       }

       $(document).ready(function() {
        $('#subject_id').select2();
    });

    $(document).ready(function() {
        $('#exam_name').select2();
    });


</script>
    @endpush
@endonce
