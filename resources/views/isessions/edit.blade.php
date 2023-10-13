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
        <li class="breadcrumb-item active">Create Session</li>
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

          <form action="{{ route('isessions.update',$isession->id) }}" method="POST">
            @csrf
              @method('PATCH')

            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Start Session:</strong>
{{--                  <input type="text" name="start_session" class="form-control" placeholder="Start Session" value="{{ $isession->start_session }}" disabled>--}}
                    <select id="start_session" class="form-control" name="start_session">
                        <option value="" name="start_session">Choose Student Start Seesion...</option>

                        @foreach($month as $key => $month_value)

                            @if($isession->start_session == $month_value->id)

                                <option value="{{ $month_value->id }}" selected>{{ $month_value->month_name }}</option>

                            @else

                                <option value="{{ $month_value->id }}">{{ $month_value->month_name }}</option>

                            @endif

                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>End Session:</strong>
{{--                  <input type="text" name="end_session" class="form-control" placeholder="End Session" value="{{ $isession->end_session }}">--}}
                    <select id="end_session" class="form-control" name="end_session">
                        <option value="" name="end_session">Choose Student Start Seesion...</option>

                        @foreach($month as $key => $month_value)
                            @if($isession->end_session == $month_value->id)

                                <option value="{{ $month_value->id }}" selected>{{ $month_value->month_name }}</option>

                            @else

                                <option value="{{ $month_value->id }}">{{ $month_value->month_name }}</option>

                            @endif

                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark">Update</button>
              </div>
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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <script>

            $(document).ready(function() {
                $('#start_session').select2();
            });


            $(document).ready(function() {
                $('#end_session').select2();
            });

        </script>
    @endpush
@endonce
