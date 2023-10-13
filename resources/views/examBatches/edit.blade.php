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
        <li class="breadcrumb-item active">Edit Exam Batches</li>
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



         <form action="{{ route('examBatches.update',$examBatches->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')




            <div class="row">


                <div class="form-group col-md-6">
                    <label for="exam_name">Exam Name</label>
                    <select id="exam_name" name="exam_name" class="form-control">
                        <option value="" name="exam_name">Select Exam Name...</option>
                        @foreach($ExamData as $key => $Exam_value)

                        @if($Exam_value->id == $examBatches->exam_name)
                            <option value="{{ $Exam_value->id }}" selected>{{ $Exam_value->name }}</option>
                        @else

                        <option value="{{ $Exam_value->id }}">{{ $Exam_value->name }}</option>

                        @endif
                        @endforeach
                    </select>
                </div>


                <div class="form-group col-md-6">
                    <label for="name">Select Subject</label>
                        <select class="form-control" name="subject_id" id="subject_id">
                            <option value="" name="subject_id">Select Subject...</option>
                            @foreach($subjectData as $key => $subject_value)

                            @if($subject_value->id == $examBatches->subject_id)
                            <option value="{{ $subject_value->id }}" selected>{{ $subject_value->name }}</option>
                            @else

                            <option value="{{ $subject_value->id }}">{{ $subject_value->name }}</option>

                            @endif

                            @endforeach
                        </select>
                </div>

             <div class="form-group col-md-6">
                <label for="examdate">Exam Date</label>
                <input type="date" class="form-control" name="exam_date" value="{{ $examBatches->exam_date}}" id="myDate" onchange="myFunction(this.value)">

                <!-- if want show error in single  -->
              </div>


              <div class="form-group col-md-6">
                  <label for="day">Day</label>
                  <input type="text" id=day class="form-control" name="day" value="{{ $examBatches->day }}" >
                  </div>

            <div class="form-group col-md-6">
                <label for="start_time">Exam Start Time</label>
                <input type="time" class="form-control" name="start_time" placeholder="hh:mm AM/PM" value="{{ $examBatches->start_time }}">
                <!-- if want show error in single  -->

            </div>
            <div class="form-group col-md-6">
                <label for="end_time">Exam End Time</label>
                <input type="time" class="form-control" name="end_time" placeholder="hh:mm AM/PM" value="{{ $examBatches->end_time }}">
                <!-- if want show error in single  -->
            </div>
            <!-- <div class="form-group col-md-6">
              <label for="center_name">Institute Center Name</label>
              <input type="text" class="form-control" name="center_name" placeholder="Enter Center Name" value="{{ $examBatches->center_name }}"> -->
              <!-- if want show error in single  -->
            <!-- </div> -->

            <div class="form-group col-md-6">
                <label for="batch_number">Batch Number</label>
                <input type="number" class="form-control" name="batch_number" placeholder="Batch Number" value="{{ $examBatches->batch_number }}">
                <!-- if want show error in single  -->

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark">Update</button>
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

           function myFunction() {
           var x = document.getElementById("myDate").value;

           var d = new Date(x);

           var str = d.toString().split(" ");

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
