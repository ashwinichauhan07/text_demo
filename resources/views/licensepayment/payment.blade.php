@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid"><br><br>
            <div class="card mb-4">
                <div class="card-header">
                    Payment Using UPI </i>
                </div>

        </div>
            <div class="form-group col-6">
                <label for="instituteEmail1">UPI ID Google Pay,BHIM,Phone Pay and more</label>
                <p class="alert alert-success">9730613142@ybl</p>
            </div>
            <div class="form-group col-6">
                <label for="instituteEmail1">Scan & Pay</label>
                <p class="alert alert-success">
                    <img src="{{ asset('public/qrcode/Phone.png') }}" style="width: 400px; height: 400px; padding:5px; margin: auto">
                </p>
            </div>
{{--        </div>--}}

{{--            </div>--}}

                <form method="POST" action="{{ route('licensepayment.store') }}">

                    @csrf
                    @method('put')



                    @foreach($student_sub as $student_value)

                    <input type="hidden" name="subject_id[]" value="{{ $student_value->id }}">

                        <input type="hidden" name="student_id[]" value="{{ $student_value->student_id }}">

                        <input type="hidden" name="amount[]" value="{{ $license->license_fee }}">

                    @endforeach

                    {{--                                    <input type="hidden" name="code" value="{{ $validator['code'] }}">--}}

                    {{--                                    <input type="hidden" name="startExam" value="{{ $validator['startExam'] }}">--}}

                    {{--                                    <input type="hidden" name="endExam" value="{{ $validator['endExam'] }}">--}}

                    {{--                                    <input type="hidden" name="duration" value="{{ $validator['duration'] }}">--}}

                    {{--                                    <input type="hidden" name="instruction" value="{{ $validator['instruction'] }}">--}}

                    {{--                                    <input type="hidden" name="instruction_time" value="{{ $validator['instruction_time'] }}">--}}

                    {{--                                    <input type="hidden" name="pass_percentage" value="{{ $validator['pass_percentage'] }}">--}}



                    <div class="row mt-4">
                        <div class="col">
                            <p class="text-center">
                                <button type="submit" class="btn btn-success">SEND</button>
                            </p>
                        </div>
                    </div>

                </form>



    </main>

@endsection

@once
    @push('scripts')
        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                crossorigin="anonymous"></script>

                 <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
                crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script type="text/javascript">
            // window.onload = ()=> {
            // 	var del = document.querySelectorAll(".delete");
            // 	del.forEach(function(item, index){
            // 		item.onclick = ()=> {
            // 			if (confirm("Are you sure you want to delete !")) {
            // 				return true;
            // 			} else {
            // 				return false;
            // 			}
            // 		}
            // 	});
            // }
        </script>


    @endpush
@endonce
