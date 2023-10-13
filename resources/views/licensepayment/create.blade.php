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
                <li class="breadcrumb-item active">Payment of Licenses</li>
            </ol>
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                            <div class="table-responsive">
                                <form action="{{ route('licensepayment.payment') }}" method="POST">
                                    @csrf
                                    @method('put')
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th><input type="checkbox" id="upper_check" onclick=""> Student Name</th>
                                        <th><input type="checkbox" id="subject_check" onclick=""> Student Subject</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($student as $key => $student_value)

{{--                                        @foreach ($licensePayment as $key => $license_value)--}}
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td><input type="checkbox" name="student_id[]" value="{{ $student_value->id }}" class="check"> {{ $student_value->user->name }} {{ $student_value->father_name }} {{ $student_value->lastname }}</td>
{{--                                            <td>{{ $student_value->user->name }} {{ $student_value->father_name }} {{ $student_value->lastname }}</td>--}}
                                            <td>
                                                @foreach ($student_value->student_subject as $key => $studentvalue)
                                                <input type="checkbox" value="{{ $studentvalue->id }}" name="subject_id[]" class="check_sub" id="subject_check" onclick="(getCheckedCheckboxesFor('employee'))">&nbsp;{{ $studentvalue->subject->name }},
                                                @endforeach
                                            </td>
{{--                                   @endforeach--}}
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Student Name</th>
                                        <th>Student Subject</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br>
                            <div class="form-group col-md-4">
                                <label for="subject_id">Amount</label>
                                <input type="text" name="payment_id" id="payment_id" class="form-control"
                                       value="" readonly>

{{--                                <input type="button" onclick="alert(getCheckedCheckboxesFor('employee'));" value="Get Values" />--}}
                            </div>
                            <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-dark">Pay</button>
                            </div>
                            </form>

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
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script>

            var payment_id = document.getElementById('payment_id').value;
            function getCheckedCheckboxesFor(checkboxName) {
                var checkboxes = document.querySelectorAll("#subject_check:checked"), values = [];
                Array.prototype.forEach.call(checkboxes, function(el) {
                    values.push(el.value);
                });
                if (values[0] == "on") {
                    // console.log(values.length - 1);
                    var license = {{ $license->license_fee }};
                    var i = "";
                    var total = license;
                    for (i = 0; i < values.length - 1; i++) {
                        total = license * i;
                    }
                }
                    else {
                    var license = {{ $license->license_fee }};
                    var i = "";
                    var total = license;
                    for (i = 0; i < values.length; i++) {
                        total = license * i;
                    }
                }
                    payment_id.value = total + {{ $license->license_fee }};
                    payment_id.style.backgroundColor = "green";
                    payment_id.style.color = "white";
                    payment_id.style.fontWeight = "600";
                }

                // console.log(license);
            $('#subject_check').click(function() {
                if ($(this).prop('checked')) {
                    $('.check_sub').prop('checked', true);
                    getCheckedCheckboxesFor();
                } else {
                    $('.check_sub').prop('checked', false);
                }
            });

            $('#upper_check').click(function() {
                if ($(this).prop('checked')) {
                    $('.check').prop('checked', true);
                } else {
                    $('.check').prop('checked', false);
                }
            });





        </script>
    @endpush
@endonce
