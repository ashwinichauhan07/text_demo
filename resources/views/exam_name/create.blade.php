@extends('layouts.demo')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item active">Create Course</li>
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

            <form method="POST" action="{{ route('exam_name.store') }}">
            @csrf
            <div class="form-row">


              <div class="form-group col-md-6">
                <label for="inputEmail4">Exam Name</label>
                <input type="text" class="form-control" name="name" placeholder="Exam Name" value="{{ old('name') }}">
                <!-- if want show error in single  -->
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
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
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

        window.onload = ()=> {
            var course_id = document.getElementById('course_id');
            var subject_id = document.getElementById('subject_id');
            // console.log(course_id);
            // console.log(...formData);
            course_id.onchange = ()=> {
                var formData = new FormData();
                formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
                formData.append("course_id",course_id.value);
                // console.log(course_id.value);
                var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // console.log(this.responseText);
                        var response = JSON.parse(this.responseText);
                        //console.log(response.status);
                        if (response.status) {
                            //console.log(response.data);
                            //console.log(subject_id.options.length=0);
                            subject_id.options.length=0;
                            for (var i = 0; i <= response.data.length; i++) {
                                //console.log(response.data[i].name);
                                //console.log(response.data.length);

                                var opt = document.createElement("option");
                                opt.innerText = response.data[i].name;
                                opt.value = response.data[i].id;
                                subject_id.append(opt);
                                console.log(opt);
                            }
                        }
                    }
                  };
                  xhttp.open("POST", "{{ route('subfilter') }}", true);
                  // xhttp.setRequestHeader("X-CSRF-Token",document.querySelector('meta[name="csrf-token"]').content);
                  xhttp.send(formData);
            }
        }
    @endpush
@endonce
