@extends('layouts.admin')

@section('title', 'Page language')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item active">Create Practise Type</li>
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

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
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

            <form method="POST" action="{{ route('practiseType.store') }}">
            @csrf
             @method('PUT')
            <div class="form-row">

              <div class="form-group col-md-6">
                  <label for="practise_type">Select Practise Type :</label>
                    <select id="practise_type" class="form-control" name="practise_type">
                      <option value="" selected>Choose Practise Type...</option>
                      <option value="0">Keyboard Practise Type</option>
                      <option value="1">Typing Practise Type</option>
                    </select>
                </div>

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


              <div class="form-group col-md-6" id="exetype">
                <label for="inputEmail4">Practise Type</label>

                  <select id="name" class="form-control" name="practise_id">
                      <option value="" name="practise_id" >Choose Practise Type...</option>
                      @foreach($practiseTypename as $key => $practiseTypename_value)

                          <option value="{{ $practiseTypename_value->name }}">
                              {{ $practiseTypename_value->name }}
                          </option>

                      @endforeach

                  </select>
                <!-- if want show error in single  -->

         </div>

                <div class="form-group col-md-6" id="keyboaardtype">
                    <label for="inputEmail4">Practise Type</label>

                     <input type="text" name="practisetype_id" id="name_id" class="form-control">
                    </select>
                    <!-- if want show error in single  -->

                </div>



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

         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
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


            window.onload = () => {
                var practise_type = document.getElementById('practise_type');
                var exetype = document.getElementById('exetype');
                var keyboaardtype = document.getElementById('keyboaardtype');
                var name = document.getElementById('name');

                exetype.style.display = "none"
                keyboaardtype.style.display = "none"
                //
                practise_type.onchange = () => {
                    if (practise_type.value == 0){
                        keyboaardtype.style.display = "block"
                        exetype.style.display = "none"
                        name.style.display = "disabled"
                        console.log(name);
                    }
                    else if (practise_type.value == 1){
                        exetype.style.display = "block"
                        $(document).ready(function() {
                            $('#name').select2();


                        });

                        keyboaardtype.style.display = "none"
                    }
                }
            }



        </script>
    @endpush
@endonce
