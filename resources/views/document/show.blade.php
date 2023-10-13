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

                            <li class="breadcrumb-item active">View Document</li>
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

  <div class="form-group col-6">

    <label for="document">Document Name :</label>

    <p class="alert alert-success">{{ $document->name }}</p>

    </div>

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
    @endpush
@endonce
