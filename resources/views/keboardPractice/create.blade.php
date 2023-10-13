@extends('layouts.admin')

@section('title', 'upload keyboard practise')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item active">Create Keboard Practises</li>
      <a class="btn btn-dark" href="{{ route('keboardPractice.index') }}" style="margin-left: 61em;">Back</a>
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


            @if ($message = Session::get('error'))
            <div class="alert alert-danger">
              <p>{{ $message }}</p>
            </div>
          @endif

             @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
            <!-- If want show all error in one place  -->

            <form method="POST" action="{{ route('keboardPractice.store') }}">
            @csrf
             @method('PUT')
            <div class="form-row">


            <div class="form-group col-md-6">
                <label for="inputEmail4">Select Subject</label>

                <!-- if want show error in single  -->
              <select id="subject_id" class="form-control" name="subject_id">
                      <option value="" name="subject_id" >Choose Subject...</option>

                    @foreach($subjectData as $key => $subject_value)

                        <option value="{{ $subject_value->id }}">
                           {{ $subject_value->name }}
                        </option>

                    @endforeach

              </select>
               </div>


            <div class="form-group col-md-6">
                <label for="inputEmail4">Select Keboard Practise Type</label>

                <!-- if want show error in single  -->
              <select id="practise_type" class="form-control" name="practise_type">
                      <option name="practise_type" >Choose Keboard Practise Type...</option>
              </select>
               </div>

              <div class="form-group col-md-6">
                <label for="inputEmail4">Name</label>
                <input type="text" class="form-control" name="name" placeholder=" Name" value="{{ old('name') }}">
                <!-- if want show error in single  -->

              </div>

              <div class="form-group col-md-6">
                <label for="inputEmail4">Description</label>
                <textarea name="desc" class="form-control" placeholder="Enter Typing data" rows="8"
                style="border-width: 4px;"></textarea>

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
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

        </script>
      <script src="{{ url('public/js/a.js') }}"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script type="text/javascript">
        	  $(document).ready(function() {
                $('#subject_id').select2();
            });

            $(document).ready(function() {
                $('#practise_type').select2();
            });
        </script>

        <script type="text/javascript">

        window.onload = ()=>{
          var subject_id = document.getElementById('subject_id');
          var practise_type = document.getElementById('practise_type');

          subject_id.onchange = ()=> {
              var formData = new FormData();
              formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
              formData.append("subject_id",subject_id.value);
              var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.status) {
                  practise_type.options.length=0;
                  for (var i = 0; i <= response.data.length; i++) {

                    var opt = document.createElement("option");
                    opt.innerText = response.data[i].name;
                    opt.value = response.data[i].id;
                    practise_type.append(opt);
                    console.log(opt);
                  }
                }
              }
            };
            xhttp.open("POST", "{{ route('practise_type') }}", true);
            xhttp.send(formData);
            }
          }



        </script>
    @endpush
@endonce
