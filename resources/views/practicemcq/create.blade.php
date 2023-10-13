@extends('layouts.admin')

@section('title', 'Create Question')

@section('sidebar')

@parent

@endsection

@section('content')
<head>
  <meta charset="UTF-8">
</head>

<main>
    <div class="container-fluid">
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">Create Question <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('practicemcq.index') }}">Back</a></li>
        </ol>
        <!-- Show Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Show Message -->
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('practicemcq.store') }}" method="POST" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            @method('POST')
                            <div class="row">

                                <div class="form-group col-5">
                                    <label for="subject_id">Subject</label>
                                    <select name="subject_id" class="form-control" id="subject_id">

                                        @foreach($subjectData as $key => $subject_value)

                                        <option value="{{ $subject_value->id }}">
                                            {{ $subject_value->name }}
                                        </option>
*
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="mcqtype">MCQ Type</label>
                                    <select id="level" class="form-control" name="mcq_type_id">

                                        <!-- <option value="" name="mcq_type_id">Choose MCQ Type</option>

                                    @error('mcq_type_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror -->

                                        @foreach($mcqtypeData as $key=> $mcqtype_value)
                                        <option value="{{ $mcqtype_value->id }}">{{ $mcqtype_value->name }}</option>
                                        @endforeach

                                    </select>
                                </div>



                                <div class="form-group col-xl-2 col-xs-12">
                                    <label for="is_mcq">Is Mcq</label>

                                    <select class="form-control" name="is_mcq" id="is_mcq">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-file">
    <input type="file" name="file" class="custom-file-input" id="chooseFile" multiple>
    <label class="custom-file-label" for="chooseFile">Select files</label>
</div>


                            <!-- Add other form fields as needed -->
                            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->


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
{{--  <script src="{{ url('public/assets/js/slim.min.js') }}"></script> --}}
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

  // Get the input element
  const input = document.getElementById('chooseFile');

// Add an event listener to handle file selection
input.addEventListener('change', function(e) {
    // Get the selected files
    const files = Array.from(e.target.files);

    // Create an array to store the file names
    const fileNames = [];

    // Loop through the selected files and add their names to the array
    files.forEach(file => {
        fileNames.push(file.name);
    });

    // Display the file names on the label
    const label = document.querySelector('.custom-file-label');
    label.textContent = fileNames.join(', ');
});



    
$(document).ready(function() {
    $('#subject_id').select2();
    $('#level').select2();
    $('#is_mcq').select2();
});

ClassicEditor
    .create(document.querySelector('#que'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#mcq_1'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#mcq_2'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#mcq_3'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#mcq_4'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#explanation'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

// for marathi editor

ClassicEditor
    .create(document.querySelector('#quemarathi'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#marathimcq_1'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#marathimcq_2'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#marathimcq_3'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#marathimcq_4'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#explanation_marathi'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

// for hindi editor


// for marathi editor
ClassicEditor
    .create(document.querySelector('#quehindi'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#hindimcq_1'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#hindimcq_2'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#hindimcq_3'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#hindimcq_4'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#explanation_hindi'), {
        removePlugins: ['ImageUpload']
    })
    .catch(error => {
        console.error(error);
    });


var mcq = document.getElementById('is_mcq');
var mcq_ans = document.getElementById('mcq_ans');
var mcq_marathians = document.getElementById('mcq_marathians');
var mcq_hindians = document.getElementById('mcq_hindians');
mcq.onchange = () => {
    if (mcq.value == 1) {
        // console.log(mcq);

        mcq_ans.style.display = "block";
        mcq_marathians.style.display = "block";
        mcq_hindians.style.display = "block";
    }

    if (mcq.value == 0) {

        mcq_ans.style.display = "none";
        mcq_marathians.style.display = "none";
        mcq_hindians.style.display = "none";
    }
    
}

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