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
      <li class="breadcrumb-item active">Update Institute <a class="btn btn-dark" style="margin-left: 52em;" href="{{ route('institute.index') }}">Back</a> </li>
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
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>

            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
          </div>
          @endif

          <form method="POST" action="{{ route('institute.update',[$institute->id]) }}"  enctype="multipart/form-data">
          {{ csrf_field() }}

          @method('PUT')
          <input type="hidden" name="userType" value="2">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $institute->user->name }}">
              <!-- if want show error in single  -->
              @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $institute->user->email }}" disabled>
            </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4">Principle name</label>
              <input type="text" class="form-control" name="principle_name" placeholder="Principle name" value="{{ $institute->principle_name }}">
            </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4">Principle Mobile</label>
              <input type="number" class="form-control" name="principle_mob" placeholder="Principle Mobile" value="{{ $institute->principle_mob }}" disabled>
            </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4">Principle Email</label>
              <input type="email" class="form-control" name="principle_email" placeholder="Principle email" value="{{ $institute->principle_email }}" disabled>
            </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4">Address</label>
              <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $institute->address }}">
            </div>

            <div class="form-group col-md-6">
              <div class="course">
                <label for="sub30wpm">Select Course</label>
                <select id="course_id" class="form-control" name="course_id[]" >
                  <!-- <option selected>Choose course</option> -->

                  @foreach($courseData as $key=> $course_value)

                  @if($institute->course_id == $course_value->id)

                  <option value="{{ $course_value->id }}" selected>{{ $course_value->name }}</option>

                  @else

                  <option value="{{ $course_value->id }}">{{ $course_value->name }}</option>

                  @endif

                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4">Start Time</label>
              <input type="time" class="form-control" name="start_time" placeholder="Address" value="{{ $institute->start_time }}">
            </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4">End Time</label>
              <input type="time" class="form-control" name="end_time" placeholder="Address" value="{{ $institute->end_time }}">
            </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4">No of PC</label>
              <input type="text" class="form-control" name="pc" placeholder="Address" value="{{ $institute->pc }}">
            </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4">Institute Code</label>
              <input type="number" class="form-control" name="institute_code" placeholder="Institute Code" value="{{ $institute->institute_code }}">
            </div>

           <div class="form-group col-md-6">
            <div class="form-group">
               <label for="inst_logo">Institute Logo</label>
               <input type="file" name="inst_logo" class="form-control" value="{{ old( $institute->inst_logo ) }}" onchange="previewFile(this)" />
               <img src="{{asset('public/adminlogo')}}/{{ $institute->inst_logo }}" id="previewImg" name="inst_logo" alt="" style="max-width:130px;margin-top: 20px;"  />
            </div>
          </div>

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

         <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
        <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>


          <script type="text/javascript">


    $(function() {
  // from http://stackoverflow.com/questions/45888/what-is-the-most-efficient-way-to-sort-an-html-selects-options-by-value-while
  var my_options = $('.course select option');
  var selected = $('.course').find('select').val();

  my_options.sort(function(a,b) {
    if (a.text > b.text) return 1;
    if (a.text < b.text) return -1;
    return 0
  })

  $('.course').find('select').empty().append( my_options );
  $('.course').find('select').val(selected);

  // set it to multiple
  $('.course').find('select').attr('multiple', true);

  // remove all option
  $('.course').find('select course[value=""]').remove();
  // add multiple select checkbox feature.
  $('.course').find('select').multiselect();
})
        </script>

      <script>
      function previewFile(input)
      {
        var file = $("input[type=file]").get(0).files[0];
        if (file)
         {
          var reader = new FileReader();
          reader.onload = function()
          {
            $('#previewImg').attr("src",reader.result);
          }
            reader.readAsDataURL(file);
         }
      }
    </script>
    @endpush
@endonce
