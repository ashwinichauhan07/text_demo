@extends('layouts.admin')

@section('title', 'Page language')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item active">Create Home Key</li>
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

            <form method="POST" action="{{ route('homekey.store') }}">
            @csrf
             @method('PUT')
            <div class="form-row">


            <div class="form-group col-md-6">
                <label for="inputEmail4">Select Language</label>
                
                <!-- if want show error in single  -->
              <select id="language_id" class="form-control" name="language_id">
                      <option value="" name="language_id" >Choose Language...</option>

                    @foreach($languageData as $key=> $language_value)
                    
                    <option value="{{ $language_value->id }}">{{ $language_value->name }}</option>
                    
                    @endforeach
            
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
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script type="text/javascript">
        	$(document).ready(function() {
                $('#language_id').select2();
                
               
            });
        </script>
    @endpush
@endonce