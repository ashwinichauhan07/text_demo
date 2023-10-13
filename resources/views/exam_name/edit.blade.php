@extends('layouts.demo')

@section('title', 'Edit Subject Expert')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Edit Course</li>
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

                                <form action="{{ route('exam_name.update', $examName->id) }}" method="POST">
                                          {{ csrf_field() }}
                                          @method('PUT')

                                          <input type="hidden" name="userType" value="5">



                                          <div class="form-group col-6">

                                            <label for="inputEmail4">Exam Name</label>
                                            <input type="text" class="form-control" id="" placeholder="Enter Exam Name" name="name" value="{{ $examName->name }}" required>

                                          </div>


                                          <button type="submit" class="btn btn-dark ml-2 mt-4">Update</button>

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
        <script src="{{ url('/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/datatables-demo.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script type="text/javascript">
          $(document).ready(function() {
                $('#subject_id').select2();
            });
        </script>
    @endpush
@endonce
